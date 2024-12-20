@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">

        @include('business.leftNavigation')

        <div class="col-md-10">

            <form id="frmverified" name="frmverified" method="post" action="{{route('addbusinessverification')}}">
                @csrf
                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <div class="container-fluid p-0" id="detail-form4">

                    <div class="tab-hed">Get Verified</div>

                    <div class="getverified_title">
                        Payment Details
                    </div>

                    <div class="col-md-12 evident-logo-right text-right">
                        <h4>Powered by: <img src="{{ url('public/images/evident.png') }}" alt=""></h4>
                    </div>

                    <div class="col-md-5 payment_block_left">
                        <div class="verified_logo_bg"><img src="{{ url('public/images/verified-logo.png') }}" alt=""></div>
                        <h3>ORDER SUMMERY</h3>
                        <table class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ITEM</th>
                                    <th>QTY</th>
                                    <th class="text-right">PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Background & Identity Check</td>
                                    <td>1</td>
                                    <td class="text-right">$19.95</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="total_summery">
                            <p>Total : <span>$19.95</span></p>
                            <p>Service Fee : <span>10%</span></p>
                            <p>Grand Total : <span>$22</span></p>
                        </div>
                    </div>

                    <div class="col-md-7 payment_block_right">
                        <h4>PAYMENT SELECTION</h4>
                        <div class="payment-item" style="display:none;">
                            <h5>SAVED CARDS <a href="#" class="edit_links">Edit</a></h5>
                            <div class="selection" id="card_1">
                                <div class="card_shapes1"><img src="{{ url('public/images/card-shapes.png') }}" alt=""></div>
                                <input type="radio" name="subscription" id="subscription" />
                                <label for="subscription">
                                    <span id="numbercard">XXXX 4023</span>
                                    <span class="cardimg"><img src="{{ url('public/images/visa-white.png') }}" alt=""></span>
                                </label>
                                <div class="check"></div>
                            </div>
                            <div class="selection" id="card_2" style="display:none;">
                                <div class="card_shapes2"><img src="{{ url('public/images/card-shapes1.png') }}" alt=""></div>
                                <input type="radio" name="subscription" id="subscription-2" />
                                <label for="subscription-2">
                                    <span class="numbercard">XXXX 5987</span>
                                    <span class="cardimg"><img src="{{ url('public/images/master-card.png') }}" alt=""></span>
                                </label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <div class="col-md-12 padding-0 card_details_block">

                            <div class="form-group col-md-6 card_number_block">
                                <label for="">Card Number</label>
                                <input type="text" name="cardnumber" id="card_number" placeholder="0000 0000 0000 0000" class="form-control" autocomplete="off" maxlength="16">
                                <div class="cardpayment-logo">
                                    <img src="{{ url('public/images/visa-black.png') }}" alt="" class="visa_card">
                                    <img src="{{ url('public/images/master-card.png') }}" alt="" class="master_card">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Name on Card</label>
                                <input type="text" name="namecard" id="name_card" placeholder="Enter Your Name Here" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Expiry Date</label>
                                <input type="text" name="exirydate" id="expiry_date" placeholder="MM / YY" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">CVV</label>
                                <input type="number" name="cvv" id="cvv" placeholder="- - -" class="form-control" autocomplete="off" onKeyPress="if (this.value.length == 3)
                                            return false;">
                                <a href="#" class="cvv_code" data-toggle="popover" data-trigger="hover" data-content="Lorem Ipsum is simply dummy text">?</a>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="switch" id="cards_check">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                                <span>Save This Card</span>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn-bck" id="bck-btn4"><i class="fa fa-arrow-left"></i> Back</button>
                            </div>

                            <div class="col-md-6 text-right">
                                <button type="button" class="btn-nxt" id="btn-nxt5">Continue <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <br>
                    </div>

                </div>

                <div class="container-fluid p-0" id="verified-form1" style="display: none;">

                    <div class="tab-hed">Get Verified</div>

                    <div class="getverified_title">
                        Details
                    </div>

                    <div class="col-md-9">
                        <h3><b>WELCOME</b></h3>
                    </div>

                    <div class="col-md-3 evident-logo-right-1">
                        <img src="{{ url('public/images/evident.png') }}" alt="">
                    </div>

                    <div class="col-md-12">
                        <div class="details_section">
                            <p>
                                Completing your background check increases your trust & safety status on Omnebook. We will notify you when the results are complete
                            </p>
                            <h5><b>A quick legal notice:</b></h5>
                            <p>
                                With your permission and understanding, Omnebook, Inc. (the “Company”) is working with Evident ID, Inc. (“EvidentID”) to obtain a consumer report that will include a criminal background check of federal, state, and local criminal court records, a review of public sex offender registries, and Social Security number verification in connection with your request to use or your ability to continue to use the Omnebook platform. Although Omnebook does not believe that this consumer report is being obtained for an employment purpose, Omnebook and Evident ID will nonetheless comply with the requirements of the Fair Credit Reporting Act and related state laws that apply specifically to consumer reports obtained for employment purposes.
                            </p>
                            <p>
                                After you’ve completed the form, you can check the status of your background check at {website link here}
                            </p>
                        </div>
                        <p class="candidate_info">
                            CANDIDATE INFORMATION
                            <span>* REQUIRED</span>
                        </p>
                    </div>

                    <div class="col-md-12 details_verified_form1">

                        <div class="form-group col-md-4">
                            <label for="">First Name <span id="star">*</span></label>
                            <input type="text" name="firstname" id="first_name" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Middle Name</label>
                            <input type="text" name="middlename" id="middle_name" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Last Name <span id="star">*</span></label>
                            <input type="text" name="lastname" id="last_name" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Date Of Birth <span id="star">*</span></label>
                            <input type="text" name="dateofbirth" id="date_birth" placeholder="MM / DD / YYYY" class="form-control" autocomplete="off">
                            <script>
                                $('#date_birth').datepicker();

                            </script>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Social Security Number <span id="star">*</span></label>
                            <input type="number" name="securitynumber" id="security_number" placeholder="XXX - XX - XXX" class="form-control" onKeyPress="if (this.value.length == 8)
                                        return false;" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Phone number <span id="star">*</span></label>
                            <input type="number" name="phonenumber" id="phone_number" placeholder="111 - 11 - 111" class="form-control" onKeyPress="if (this.value.length == 8)
                                        return false;" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Email <span id="star">*</span></label>
                            <input type="email" name="email" id="eamil" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12 checking_circle">
                            <input type="radio" name="radio_verified" id="radio_verified">
                            <label for="radio_verified">
                                By checking this circle, you agree to Omnebook, Inc. and Evident ID, Inc. Privacy Policy, and consent to Evident ID contacting you by email, phone, or SMS texts with information relating to your background check.
                            </label>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn-bck" id="back_verified"><i class="fa fa-arrow-left"></i> Back</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn-nxt" id="verified_1">Continue <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <br>
                    </div>

                </div>

                <div class="container-fluid p-0" id="verified-form2" style="display: none;">

                    <div class="tab-hed">Get Verified</div>

                    <div class="getverified_title">
                        FCRA Disclaimer
                    </div>

                    <div class="col-md-9 summary-area">
                        <div class="form-group">
                            <input type="text" name="title" id="title" value="Summery of Your Rights" class="form-control" readonly>
                            <span class="summary-icon"><i class="fa fa-file-text"></i></span>
                        </div>

                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="10" class="form-control" readonly></textarea>
                        </div>
                        <div class="form-group border-verified-top">
                            <label for="summary_receipt">
                                <input type="checkbox" name="summary_receipt" id="summary_receipt">
                                I acknowledge receipt of the Summary of Your Rights Under the Fair Credit Reporting ACT (FCRA) and certify that i have read and understand this document.
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3 evident-logo-right text-right">
                        <h4><img src="{{ url('public/images/evident.png') }}" alt=""></h4>
                    </div>

                    <div class="col-md-12">
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn-bck" id="back_verified_1"><i class="fa fa-arrow-left"></i> Back</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn-nxt" id="verified_2">Continue <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <br>
                    </div>

                </div>

                <div class="container-fluid p-0" id="verified-form3" style="display: none;">

                    <div class="tab-hed">Get Verified</div>

                    <div class="getverified_title">
                        Authorization
                    </div>

                    <div class="col-md-9 summary-area">
                        <div class="form-group">
                            <input type="text" name="title" id="title" value="Authorize" class="form-control" readonly>
                            <span class="summary-icon"><i class="fa fa-file-text"></i></span>
                        </div>

                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="10" class="form-control" readonly></textarea>
                        </div>

                        <div class="form-group border-verified-top">
                            <label for="receive_consumer">
                                <input type="checkbox" name="receive_consumer" id="receive_consumer">
                                Please check this box if you would like to receive a copy of a consumer report.
                            </label>
                        </div>
                        <div class="form-group electronice-signature-txt">
                            <i class="fa fa-pencil"></i> Electronic signature
                        </div>
                        <p>By typing my name below, I consent to the background checks and indicate my agreement to all of the above.</p>
                        <div class="row">
                            <div class="form-group col-md-6 autorize_name_block">
                                <label for="">Full Name</label>
                                <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control">
                                <span class="autorize_icon"><img src="{{ url('public/images/icon-verified-autorize.png') }}" alt=""></span>
                            </div>
                            <div class="form-group col-md-6"></div>
                        </div>
                    </div>

                    <div class="col-md-3 evident-logo-right text-right">
                        <h4><img src="{{ url('public/images/evident.png') }}" alt=""></h4>
                    </div>

                    <div class="col-md-12">
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn-bck" id="back_verified_2"><i class="fa fa-arrow-left"></i> Back</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn-nxt" id="verified_3">Continue <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="container-fluid p-0" id="verified-form4" style="display: none;">
                    <div class="tab-hed">Get Verified</div>
                    <div class="getverified_title">
                        Complete
                    </div>
                    <div class="col-md-12 evident-logo-right text-right">
                        <h4><img src="{{ url('public/images/evident.png') }}" alt=""></h4>
                    </div>

                    <div class="col-md-12 complete-section text-center">
                        <h2>ALL DONE!</h2>
                        <p>
                            Thanks for submitting your background check forms. You are one set closer to being a Omnebook Verified Busienss. <br>
                            Once the process is complete, you will see the Verified badge on your profile. <br>
                            You can view the status of your background check here.
                        </p>
                        <img src="{{ url('public/images/verified-logo.png') }}" alt="">
                    </div>

                    <div class="col-md-12">
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn-bck" id="back_verified_3"><i class="fa fa-arrow-left"></i> Back</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn-nxt" id="verified_4">Continue <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="container-fluid p-0" id="detail-form5" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>

                    <section class="row">
                        <div class="col-md-12 text-justify">
                            <br>
                            <p><span style="font-size: 22px;font-weight: bold;">YOU’RE ALMOST DONE!</span> This last section is where you will describe your programs, add attractive images, description, prices, taxes, terms
                                and conditions, contracts, one-time payments, recurring payment, sessions, and more. We recommend you make sure your price sare competitive to your skill level and to what the market demands</p>
                        </div>
                        <div class="col-md-12 text-center">
                            <br>
                            <span style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Select Your Service Type</span><br>
                            <label>Click on the service option above start the process. Only choose the option that best represents the type of services you offer.<br> Don’t worry, you can set up more than one type of service.</label><br>
                        </div>
                        <div class="col-md-12">
                            <br> <br>
                            <div class="custome-div col-md-8">
                                <input type="radio" id="test1" name="radio-group" checked value="individual">
                                <label for="test1">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="/public/images/newimage/individual.jpeg" class="pro_card_img1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="tab-hed1">Individual</div>
                                            <p>A business service provider that offers personal training, coaching, nutrition advice, instructor and any business offering one-on-one services online, at a specific location or traveling to clients.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <br>
                            <div class="custome-div col-md-8">
                                <input type="radio" id="test2" name="radio-group" value="classes">
                                <label for="test2">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="/public/images/newimage/media.jpg" class="pro_card_img1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="tab-hed1">Classes</div>
                                            <p>A business service provider that offers different types of group classes and training either online, your place of business or on location.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <br>
                            <div class="custome-div col-md-8">
                                <input type="radio" id="test3" name="radio-group" value="experience">
                                <label for="test3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="/public/images/newimage/get-started.jpg" class="pro_card_img1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="tab-hed1">Experience</div>
                                            <p>A business service provider that offers different types of adventures, tours and experiences either online, your place of business or on location.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <br><br>

                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn5"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt6">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="detail-form6" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>
                    <section class="row">
                        <div class="col-md-4">
                            <br>
                            <br>
                            <br>
                            <!--<button class="btn-cate">Click To Add Activity Category</button>-->
                            <select name="frm_servicesport" id="frm_servicesport" class="form-control">
                                <option value="">Choose a Sport/Activity</option>
                                <option value="18">Aerobics</option>
                                <option value="26">Archery</option>
                                <option value="31">Badminton</option>
                                <option value="71">Barre</option>
                                <option value="4">Baseball</option>
                                <option value="3">Basketball</option>
                                <option value="33">Beach Vollyball</option>
                                <option value="15">Bouldering</option>
                                <option value="65">Bungee Jumping</option>
                                <optgroup label="Camps &amp; Clinics">
                                    <option value="29">Day Camp</option>
                                    <option value="28">Sleep Away</option>
                                    <option value="77">Winter Camp</option>
                                </optgroup>
                                <option value="63">Canoeing</option>
                                <optgroup label="Cycling">
                                    <option value="72">Indoor cycling</option>
                                </optgroup>
                                <option value="74">Dance</option>
                                <option value="39">Diving</option>
                                <optgroup label="Field Hockey">
                                    <option value="6">Ice Hockey</option>
                                </optgroup>
                                <option value="1">Football</option>
                                <option value="2">Golf</option>
                                <option value="68">Gymnastics</option>
                                <option value="58">Hang Gliding</option>
                                <option value="70">Hiit</option>
                                <option value="60">Hiking - Backpacking</option>
                                <option value="42">Horseback Riding</option>
                                <option value="69">ice Skating</option>
                                <option value="40">Kayaking</option>
                                <option value="41">lacrosse</option>
                                <option value="50">Laser Tag</option>
                                <optgroup label="Martial Arts">
                                    <option value="5">Boxing</option>
                                    <option value="35">Jiu-Jitsu</option>
                                    <option value="21">Karate</option>
                                    <option value="13">Kick Boxing</option>
                                    <option value="17">Kung Fu</option>
                                    <option value="22">MMA</option>
                                    <option value="24">Self-Defense</option>
                                    <option value="46">Tai Chi</option>
                                    <option value="10">Wrestling</option>
                                </optgroup>
                                <option value="43">Massage Therapy</option>
                                <option value="25">Nutrition</option>
                                <option value="49">Paint Ball</option>
                                <option value="45">Physical Therapy</option>
                                <option value="44">Pilates</option>
                                <option value="57">Rafting</option>
                                <option value="66">Rapelling</option>
                                <option value="67">Rock Climbing</option>
                                <option value="48">Rowing</option>
                                <option value="47">Running</option>
                                <optgroup label="Sightseeing Tours">
                                    <option value="53">Airplane Tour</option>
                                    <option value="56">ATV Tours</option>
                                    <option value="55">Boat Tours</option>
                                    <option value="54">Bus Tour</option>
                                    <option value="59">Caving Tours</option>
                                    <option value="51">Helicopter Tour</option>
                                </optgroup>
                                <option value="61">Sailing</option>
                                <option value="38">Scuba Diving</option>
                                <option value="9">Sky diving</option>
                                <option value="34">Snow Skiing</option>
                                <option value="37">Snowboarding</option>
                                <option value="73">Strength &amp; Conditioning</option>
                                <option value="36">Surfing</option>
                                <option value="20">Swimming</option>
                                <option value="8">Tennis</option>
                                <option value="76">Tours</option>
                                <option value="32">Vollyball</option>
                                <option value="75">Weight training</option>
                                <option value="62">Windsurfing</option>
                                <option value="19">Yoga</option>
                                <option value="64">Zip-Line</option>
                                <option value="30">Zumba</option>
                            </select>
                            <br>
                            <input type="text" name="frm_servicetitle_two" id="frm_servicetitle_two" placeholder="Name of Program" title="servicetitle" value="" class="form-control">
                            <br />
                            <br>
                            <div class="text-center"> <label>No Service Added Yet.<br>
                                    Get started by selecting Add Activity Category to choose the activity.</label></div>
                        </div>
                        <div class="col-md-8 text-justify" style="padding: 10px 40px;">
                            <br>
                            <br>
                            <p>Let’s create your service details and prices for your independent business.
                                Let customers know why you are the best at what you do. 1-on-1 businesses can
                                be a competitive market. When creating your profile, how do you stand out from
                                others. Every image, video, description, price, background check, review, and the
                                way you deliver your services will help you become a top business professional
                                on Omnebook</p>
                            <h3>Recommended Tips to Do :</h3>
                            <p>- Create a professional profile. It’s your website and resume to potential clients.</p>
                            <p>- Sell your business and show what makes your business the best.</p>
                            <p>- Take professional pictures and make your customers feel welcomed.</p>
                            <h3>Tips Not to Do :</h3>
                            <p>- Having images that are not of professional manner, creepy or not comfortable.</p>
                            <p>- Not having a well-planned experience.</p>
                            <p>- Just going with the flow will not give you repeat business.</p>
                            <p>- Creating a generic service that customers can easily do on their own.</p>
                            <p>- Offering a service you are not qualified or skilled to do.</p>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" onclick="location.href='{{route('termsBusinessProfile')}}'"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt7">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>
            </form>

        </div>
    </div>
</div>

@include('layouts.footer')
<script src="{{ url('public/js/scripts.js') }}"></script>
@endsection
