@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

    @include('layouts.business.business_topbar')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">

                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#add" role="tab" aria-selected="false"> Manually Add Client </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#search" role="tab" aria-selected="false">Search Omnebook</a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content  text-muted">
                                                <div class="tab-pane active" id="add" role="tabpanel">
                                                    <form id="frmregister" method="post">
                                                    
                                                        <div id="systemMessage" class="alert-msgs font-red"></div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-12"><h4 class="font-red ">Personal Info</h4></div>
                                                            <div class="col-md-4 col-lg-3">
                                                                <label class="mt-10 ">First Name<span id="star">*</span></label>
                                                                <input type="text" name="firstname" id="firstname" size="30" maxlength="80" class="form-control">
                                                            </div>

                                                            <div class="col-md-4 col-lg-3">
                                                                <label class="mt-10">Last Name<span id="star">*</span></label>
                                                                <input type="text" name="lastname" id="lastname" size="30" maxlength="80" class="form-control">
                                                            </div>

                                                            <div class="col-md-4 col-lg-3">
                                                                <label class="mt-10">Email<span id="star">*</span></label>
                                                                <input type="email" name="email" id="email" class="myemail form-control" size="30" maxlength="80" autocomplete="off">
                                                            </div>

                                                            <div class="col-md-4 col-lg-3">
                                                                <label class="mt-10">Birthday<span id="star">*</span></label>
                                                                <input type="text" class="form-control border-0 dash-filter-picker flatpiker-with-border add-client-birthdate" id="dob" name="dob">
                                                            </div>

                                                            <div class="col-md-4 col-lg-3">
                                                                <label class="mt-10">Phone <span id="star">*</span></label>
                                                                <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="text-phone" class="form-control">
                                                            </div>

                                                            <div class="col-md-4 col-lg-3">
                                                                <label class="mt-10">Gender<span id="star">*</span></label>
                                                                <select class="form-control" name="gender">
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                    <option value="other">Other</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 col-lg-3">
                                                                <div class="form-group check-box-info ">
                                                                    <input class="check-box-primary-account" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder" value="1">
                                                                    <label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" title="You are paying for yourself and all added family members.">(i)</span></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">Address</h4></div>
                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                <label>Address <span id="star">*</span></label>
                                                                <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressBusiness" value="" required="" oninput="initMapCall('addressBusiness', 'stateBusiness', 'stateBusiness', 'countryBusiness', 'zipcodeBusiness', 'latitude', 'longitude')"> 
                                                            </div>
                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                <label for="City">City <span id="star">*</span></label>
                                                                <input type="text" class="form-control" name="city" id="cityBusiness" size="30" maxlength="50" value="" required="">
                                                            </div>
                                                            <input type="hidden" name="lon" id="lon" value="">
                                                            <input type="hidden" name="lat" id="lat" value="">

                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                <label for="state">State <span id="star">*</span></label>
                                                                <input type="text" class="form-control" name="state" id="state" size="30" maxlength="50" value="" required="">
                                                            </div>
                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                <label for="country">Country <span id="star">*</span></label>
                                                                <input type="text" class="form-control" name="country" id="country" size="30" maxlength="50" value="" required="">
                                                            </div> 

                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                <label for="zipcode">Zip Code <span id="star">*</span></label>
                                                                <input type="text" class="form-control" name="zipcode" id="zipcode" size="30" maxlength="50" value="" required="">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">Add Family Members (Optional)</h4></div>
                                                            <div class="error mb-10" id="familyerrormessage"></div>
                                                            <input type="hidden" name="familycnt" id="familycnt" value="0">
                                                            <div id="familymaindiv">
                                                                <div class="new-client mb-10" id="familydiv0">
                                                                    <div class="accordion" id="default-accordion-example">
                                                                        <div class="accordion-item shadow">
                                                                            <h2 class="accordion-header" id="heading0">
                                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="true" aria-controls="collapse0">
                                                                                    <div class="container-fluid nopadding">
                                                                                        <div class="row"> 
                                                                                            <div class="col-lg-6 col-md-6 col-8"> Family Member #1 </div> 
                                                                                            <div class="col-lg-6 col-md-6 col-4"> 
                                                                                                <div class="multiple-options"  id="deletediv0"> 
                                                                                                </div> 
                                                                                            </div> 
                                                                                        </div>
                                                                                    </div>
                                                                                </button>
                                                                            </h2>
                                                                            <div id="collapse0" class="accordion-collapse collapse show" aria-labelledby="heading0" data-bs-parent="#default-accordion-example">
                                                                                <div class="accordion-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">First Name<span id="star">*</span></label>
                                                                                            <input type="text" name="fname[]" id="fname" class="form-control first_name required" >
                                                                                            <span class="error" id="err_fname"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Last Name<span id="star">*</span></label>
                                                                                            <input type="text" name="lname[]" id="lname" class="form-control last_name required" >
                                                                                            <span class="error" id="err_lname"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Birthday<span id="star">*</span></label>
                                                                                            <input type="text" class="form-control border-0 dash-filter-picker flatpiker-with-border" name="birthdate[]" id="birthdate" >
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Gender<span id="star">*</span></label>
                                                                                            <select name="gender[]" id="gender" class="form-select gender" required="">
                                                                                                <option value="male">Male</option>
                                                                                                <option value="female">Female</option>
                                                                                                <option value="other">Specify other</option>
                                                                                            </select>
                                                                                            <span class="error" id="err_gender"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Relationship<span id="star">*</span></label>
                                                                                            <select name="relationship[]" id="relationship" class="form-select relationship required">
                                                                                                <option value="">Select Relationship</option>
                                                                                                <option value="Brother">Brother</option>
                                                                                                <option value="Sister">Sister</option>
                                                                                                <option value="Father">Father</option>
                                                                                                <option value="Mother">Mother</option>
                                                                                                <option value="Wife">Wife</option>
                                                                                                <option value="Husband">Husband</option>
                                                                                                <option value="Son">Son</option>
                                                                                                <option value="Daughter">Daughter</option>
                                                                                            </select>
                                                                                            <span class="error" id="err_relationship"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Phone<span id="star">*</span></label>
                                                                                            <input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                            <span class="error" id="err_mphone"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Email<span id="star">*</span></label>
                                                                                            <input type="email" name="emailid[]" id="emailid" class="form-control email" >
                                                                                            <span class="error" id="err_emailid"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Emergency Name<span id="star">*</span></label>
                                                                                            <input type="text" name="emergency_name[]" id="emergency_name" class="form-control emergency_name" >
                                                                                            <span class="error" id="err_emergency_name"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Emergency Phone <span id="star">*</span></label>
                                                                                            <input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone"  onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                            <span class="error" id="err_emergency_phone"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Emergency Email<span id="star">*</span></label>
                                                                                            <input type="text" name="emergency_email[]" id="emergency_email" class="form-control emergency_email" >
                                                                                            <span class="error" id="err_emergency_email"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Emergency Relation<span id="star">*</span></label>
                                                                                            <select name="emergency_relation[]" id="emergency_relation" class="form-select emergency_relation">
                                                                                                <option value="">Select Emergency Relationship</option>
                                                                                                <option value="Brother">Brother</option>
                                                                                                <option value="Sister">Sister</option>
                                                                                                <option value="Father">Father</option>
                                                                                                <option value="Mother">Mother</option>
                                                                                                <option value="Wife">Wife</option>
                                                                                                <option value="Husband">Husband</option>
                                                                                                <option value="Son">Son</option>
                                                                                                <option value="Daughter">Daughter</option>
                                                                                            </select>
                                                                                            <span class="error" id="err_emergency_relation"></span>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3"> 
                                                                                            <div class="form-group check-box-info">
                                                                                                <input class="check-box-primary-account" type="checkbox" id="primaryAccount" name="primaryAccount" value="1">
                                                                                                <label for="primaryAccount"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Choose the primary account holder to determine whose card covers bookings for up to two family members (e.g., Mom or Dad). All cards stored under the primary account will be available at checkout.">(i)</span></label>
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
                                                                <div class="col-md-12 col-lg-12 text-right">
                                                                    <button type="button" class="btn btn-red mt-10" id="add_family">Add New Family Member</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">How did you hear about us</h4></div>
                                                            <div class="row">
                                                                <div class="col-md-4 col-lg-3 mt-10">
                                                                    <label class="mt-10">How did you hear about us?</label>
                                                                    <select class="form-control" name="gender">
                                                                        <option value="male">Search engine (Google, Bing, etc)</option>
                                                                        <option value="female">Google maps search</option>
                                                                        <option value="other">Referral</option>
                                                                        <option value="other">Social media</option>
                                                                        <option value="other">Online communities / forums</option>
                                                                        <option value="other">Online advertisement</option>
                                                                        <option value="other">Offine advertisement</option>
                                                                        <option value="other">Noticed the physical location</option>
                                                                        <option value="other">Website</option>
                                                                        <option value="other">Event</option>
                                                                        <option value="other">School</option>
                                                                        <option value="other">Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">
                                                            Account Password</h4></div>
                                                            <div class="row">
                                                                <label class="mt-10">Please pick a password to log-in to your account later.</label>
                                                                <div class="col-md-4 col-lg-3 mt-10">
                                                                    <label class="mt-10">Password</label>
                                                                    <input type="text" name="password" id="password" class="form-control">
                                                                </div>
                                                                <div class="col-md-4 col-lg-3 mt-10">
                                                                    <label class="mt-10">Confirm Password</label>
                                                                    <input type="text" name="confirmpassword" id="confirmpassword" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row"> 
                                                            <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">
                                                                Agree to Terms, Waiver & Contract Signature</h4>
                                                            </div>
                                                            <label>To continue, please read the terms & waivers above. A signature is required to participate. </label>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <canvas id="signatureCanvas"></canvas>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-md-4 col-lg-3 col-lg-3">
                                                                        <button type="button" id="clearButton" class="btn btn-primary btn-black">Clear</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-12 text-center">
                                                                <div class="wrap-sp">
                                                                    <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
                                                                    <label for="b_trm1" class="text-center">I agree to Omnebook <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
                                                                </div>
                                                                <div id="termserror" class="error"></div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 text-center">
                                                                <button type="submit" class="btn btn-red" >Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane" id="search" role="tabpanel">
                                                    <div class="text-center font-black">
                                                        <h3 >Onboard A New Client Fast</h3>
                                                        <h4>Search for your clients on Omnebook</h4>
                                                        <p>“Your client could already have an account on Omnebook.<br>If so, get access and sync their information fast.”</p>
                                                    </div>
                                                    <div class="row check-txt-center claimyour-business">
                                                        <div class="col-md-10 col-xs-10 col-8 frm-claim">
                                                            <input id="clients_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Search by typing your clients name" autocomplete="off" data-customer-id="">
                                                            
                                                            <div class="request-access" style="display:none">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.business.footer')
@include('layouts.business.scripts')
<script type="text/javascript">

    const canvas = document.getElementById('signatureCanvas');
    const ctx = canvas.getContext('2d');
    var drawing = false;

    function startDrawing(e) {
        e.preventDefault();
        var pos = getMouseOrTouchPos(canvas, e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
        drawing = true;
    }

    function draw(e) {
        e.preventDefault();
        if (!drawing) return;

        var pos = getMouseOrTouchPos(canvas, e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }

    function stopDrawing(e) {
        e.preventDefault();
        drawing = false;
    }

    function getMouseOrTouchPos(canvas, e) {
        var rect = canvas.getBoundingClientRect();
        var clientX, clientY;

        if (e.touches && e.touches.length > 0) {
            clientX = e.touches[0].clientX;
            clientY = e.touches[0].clientY;
        } else {
            clientX = e.clientX;
            clientY = e.clientY;
        }

        return {
            x: clientX - rect.left,
            y: clientY - rect.top
        };
    }

    // Add unified event listeners
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', stopDrawing);
    canvas.addEventListener('touchcancel', stopDrawing);

    const clearButton = document.getElementById('clearButton');
    clearButton.addEventListener('click', clearCanvas);

    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
</script>

<script>
    function deletediv(i){
        var cnt = $('#familycnt').val();
        cnt--;
        $('#familycnt').val(cnt);
        $('#familydiv'+i).remove();
    }

    $(document).on("click",'#add_family',function(e){
        var cnt = $('#familycnt').val();
        var old_cnt = cnt;
        cnt++;
        var txtcount = cnt;
        txtcount += 1;
        var data = '';
        data += '<div class="new-client mb-10" id="familydiv'+cnt+'">';
        data += $('#familydiv'+old_cnt).html();
        data += '</div>';
        var re = data.replaceAll("heading"+old_cnt,"heading"+cnt);
        re = re.replaceAll("collapse"+old_cnt,"collapse"+cnt);
        re = re.replaceAll("birthday_date"+old_cnt,"birthday_date"+cnt);
        re = re.replaceAll("deletediv"+old_cnt,"deletediv"+cnt);
        re = re.replaceAll("Family Member #"+cnt,"Family Member #"+txtcount);
        var $data = $(re);
        $data.find('.check-box-info').remove();
        var modifiedData = $data[0].outerHTML;
        $('#familymaindiv').append(modifiedData);
        $('#deletediv'+cnt).html('<div class="setting-icon"> <i class="ri-more-fill"></i> <ul> <li><a onclick="deletediv('+cnt+')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li></ul></div>');

        $('.relationship').each(function(e) {
            $(this).removeClass("font-red");
        });
        $('.gender').each(function(e) {
            $(this).removeClass("font-red");
        });

        $(".required").each(function() {
            $(this).removeClass("font-red");
        });
        $('#familycnt').val(cnt);
    });
</script>

@endsection