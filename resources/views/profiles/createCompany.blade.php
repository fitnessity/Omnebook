<style>
    .dollar-span {
        left: 3px;
        position: relative;
        top: 45px;
    }

    .day_circle {
        width: 50px;
        height: 50px;
        border-radius: 25px;
        background: beige;
        margin-left: 30px;
        box-shadow: 0 0 0 3px beige;
        cursor: pointer;
    }

    .day_circle_fill {
        width: 50px;
        height: 50px;
        border-radius: 25px;
        background: red;
        margin-left: 30px;
        box-shadow: 0 0 0 3px red;
        cursor: pointer;
    }

    s .day_circle p {
        position: relative;
        top: 21%;
        text-transform: capitalize;
    }

    #service_new {
        font-size: 16pt;
    }

    p.my-space-reduce {
        padding: 0;
        margin: 0;
    }

    h1.step2-title {
        margin: 10px;
    }

    .form-control {
        height: auto !important;
    }

    .my-new-date {
        margin-top: 15px;
    }

    .edu-exp {
        width: 75%;
    }

    div#company_education_skill {
        text-align: center;
    }

    div#CreateCompanyModal {
        width: 900px;
        max-height: 100% !important;
        margin: 0 auto;
        display: block;
    }
    }

    .employe-title h3 {
        font-size: 30px;
    }

    table.dp_monthpicker.dp_body td {
        padding: 15px !important;
    }

    .Zebra_DatePicker {
        background: #666;
        border-radius: 4px;
        box-shadow: 0 0 10px #888;
        color: #222;
        font: 13px Tahoma, Arial, Helvetica, sans-serif;
        padding: 3px;
        position: absolute;
        display: table;
        z-index: 1200 width: 35% !important;
        margin-top: 40px;
        margin-left: 16px;
    }

    .user_img img {
        height: 110px;
        width: 110px;
        border-radius: 55px;
    }

    img.header_img {
        position: absolute;
        left: 0;
    }

    hr.heading_hr {
        width: 10%;
        color: #f53b49;
        margin-top: 0;
        border-top: 3px solid;
        position: absolute;
        margin-bottom: 0 !important;
    }

    .introduction_section,
    .Education_section,
    .Company_section {
        padding-left: 16.7%;
    }

    h3 {
        color: #f53b49;
    }

    .modal_buttons {
        text-align: center;
    }

    .btn.btn-secondary {
        width: 249px;
        display: inline-block;
        font-size: 23px;
        margin: 40px 0 25px;
        background: #f53b49 none repeat scroll 0 0;
        border: 1px solid #f53b49;
        padding: 12px 0;
        cursor: pointer;
        text-transform: uppercase;
        color: #fff;
        border-radius: 0px;
    }

    .user_img {
        text-align: center;
        margin: 5% 0px;
    }

    /*    .avatar {*/
    /*  vertical-align: middle;*/
    /*  width: 120px;*/
    /*  height: 120px;*/
    /*  border-radius: 50%;*/
    /*}*/
    .user_img_content {
        margin: 3% 0px;
    }

    .header_content {
        padding: 0px 7%;
    }

    span.user-img>img {
        width: 100%;
        height: 100%;
        border-radius: 100px;
    }

    h4.heading {
        font-size: 22px;
        font-weight: 600;
        text-transform: uppercase;
        margin: 20px 0;
        border-bottom: 3px solid #f53b49;
        width: 70%;
        text-align: center;
        margin: 0px auto 20px auto;
        color: #f53b49;
    }

    span.Zebra_DatePicker_Icon_Wrapper {
        width: 100% !important;
    }

    .Zebra_DatePicker *,
    .Zebra_DatePicker :after,
    .Zebra_DatePicker :before {
        box-sizing: content-box !important
    }

    .Zebra_DatePicker * {
        padding: 0
    }

    .Zebra_DatePicker table {
        border-collapse: collapse;
        border-radius: 4px;
        border-spacing: 0;
        width: 100%
    }

    .Zebra_DatePicker td,
    .Zebra_DatePicker th {
        padding: 5px;
        cursor: pointer;
        text-align: center;
        min-width: 25px;
        width: 25px
    }

    .Zebra_DatePicker .dp_body td,
    .Zebra_DatePicker .dp_body th {
        border: 1px solid #bfbfbf
    }

    .Zebra_DatePicker .dp_body td:first-child,
    .Zebra_DatePicker .dp_body th:first-child {
        border-left: none
    }

    .Zebra_DatePicker .dp_body td:last-child,
    .Zebra_DatePicker .dp_body th:last-child {
        border-right: none
    }

    .Zebra_DatePicker .dp_body tr:first-child td,
    .Zebra_DatePicker .dp_body tr:first-child th {
        border-top: none
    }

    .Zebra_DatePicker .dp_body tr:last-child td,
    .Zebra_DatePicker .dp_body tr:last-child th {
        border-bottom: none
    }

    .Zebra_DatePicker .dp_body td {
        background: #e6e5e5
    }

    .Zebra_DatePicker .dp_body .dp_weekend {
        background: #d6d6d6
    }

    .Zebra_DatePicker .dp_body .dp_not_in_month {
        background: #e0e6f2;
        color: #98acd4
    }

    .Zebra_DatePicker .dp_body .dp_time_controls_condensed td {
        width: 25%
    }

    .Zebra_DatePicker .dp_body .dp_current {
        color: #cc236b
    }

    .Zebra_DatePicker .dp_body .dp_selected {
        background: #b56a6a;
        color: #fff
    }

    .Zebra_DatePicker .dp_body .dp_disabled {
        background: #f2f2f2;
        color: #ccc;
        cursor: text
    }

    .Zebra_DatePicker .dp_body .dp_disabled.dp_current {
        color: #b56a6a
    }

    .Zebra_DatePicker .dp_body .dp_hover {
        color: #fff;
        background: #88a09e
    }

    .Zebra_DatePicker .dp_body .dp_hover.dp_time_control {
        background-color: #8c8c8c;
        color: #fff
    }

    .Zebra_DatePicker .dp_monthpicker td,
    .Zebra_DatePicker .dp_timepicker td,
    .Zebra_DatePicker .dp_yearpicker td {
        width: 33.3333%
    }

    .Zebra_DatePicker .dp_timepicker .dp_disabled {
        border: none;
        color: #222;
        font-size: 26px;
        font-weight: 700
    }

    .Zebra_DatePicker .dp_time_separator div {
        position: relative
    }

    .Zebra_DatePicker .dp_time_separator div:after {
        content: ":";
        color: 1px solid #bfbfbf;
        font-size: 20px;
        left: 100%;
        margin-left: 2px;
        margin-top: -13px;
        position: absolute;
        top: 50%;
        z-index: 1
    }

    .Zebra_DatePicker .dp_header {
        margin-bottom: 3px
    }

    @supports (-ms-ime-align:auto) {
        .Zebra_DatePicker .dp_header {
            font-family: 'Segoe UI Symbol', Tahoma, Arial, Helvetica, sans-serif
        }
    }

    .Zebra_DatePicker .dp_footer {
        margin-top: 3px
    }

    .Zebra_DatePicker .dp_footer .dp_icon {
        width: 50%
    }

    .Zebra_DatePicker .dp_actions td {
        border-radius: 4px;
        color: #fff
    }

    .Zebra_DatePicker .dp_actions .dp_caption {
        font-weight: 700;
        width: 100%
    }

    .Zebra_DatePicker .dp_actions .dp_next,
    .Zebra_DatePicker .dp_actions .dp_previous {
        *padding: 0 10px
    }

    .Zebra_DatePicker .dp_actions .dp_hover {
        background-color: #8c8c8c;
        color: #fff
    }

    .Zebra_DatePicker .dp_daypicker th {
        background: #ed3948;
        cursor: text;
        font-weight: 700
    }

    .Zebra_DatePicker.dp_hidden {
        display: none
    }

    .Zebra_DatePicker .dp_icon {
        height: 16px;
        background-image: url(icons.png);
        background-repeat: no-repeat;
        text-indent: -9999px;
        *text-indent: 0
    }

    .Zebra_DatePicker .dp_icon.dp_confirm {
        background-position: center -123px
    }

    .Zebra_DatePicker .dp_icon.dp_view_toggler {
        background-position: center -91px
    }

    .Zebra_DatePicker .dp_icon.dp_view_toggler.dp_calendar {
        background-position: center -59px
    }

    button.Zebra_DatePicker_Icon {
        background: url(icons.png) center top no-repeat;
        border: none;
        cursor: pointer;
        display: block;
        height: 16px;
        line-height: 0;
        padding: 0;
        position: absolute;
        text-indent: -9000px;
        width: 16px
    }

    button.Zebra_DatePicker_Icon.Zebra_DatePicker_Icon_Disabled {
        background-position: center -32px;
        cursor: default
    }

    .pad {
        padding-top: 10px;
    }

</style>
<style>
    .dlt {
        cursor: not-allowed;
    }

    .delete_icon {
        float: right;
        color: #f53b49;
        position: relative;
        top: -20px;
    }

    span.brfcse {
        width: 36%;
        margin: 0 auto;
    }


    span.display_servicesport {
        padding-left: 0px !important;
    }

    .brfcse i.fa.fa-briefcase {
        color: #ffffff;
        font-size: 36px;
        background-color: #f53b49;
        padding: 25%;
        border-radius: 100%;
        position: relative;
        top: -47px;
    }

    .setterms {
        margin-bottom: 17px;
        padding-left: 17px;
        color: #f53b49;
    }

    #taxmsg,
    #setnumbermsg {
        padding: 5px;
        border-radius: 4px;
        text-align: left;
        border: 1px solid #f53b49;
        background: #ff7e7e;
        color: #fff;
        width: fit-content;
    }

    .textsam {
        padding: 5px;
    }

    .hrsam {
        border-top: 1px solid #dedede;
        padding: 5px 0px;
        text-align: initial;
    }

    .col-md-3.often {
        text-align: left;
        padding-left: 0px;
        padding-right: 5px;
    }

    .percentage {
        border-bottom: 1px solid;
        width: 10%;
        text-align: -webkit-right;
        padding: 2px 8px;
        border-radius: 1px;
    }

    .msesinput {
        border: 1px solid;
        padding: 10px;
        width: 30%;
        float: left;
        margin-bottom: 11px;
    }

    .m-1 {
        margin-top: 18px
    }

    .pd-0 {
        padding-left: 0;
        padding-right: 7px;
    }

    .qh-steps-form .btn.active span.glyphicon {
        color: #ffffff;
    }

    h2.additionheading {
        color: #f53b49;
        text-align: initial;
        font-size: 17px;
    }

    .col-md-3.samm,
    .col-md-6.samm,
    .col-md-12.samm {
        display: contents;
        text-align: left;
    }

    label.setupprice {
        margin-bottom: -12px;
    }

    input.offpro {
        width: unset;
        margin-right: 9px;
        margin-top: 7px;
    }

    .multiples {
        padding: 5px 0;
        text-align: left;
        font-size: 17px;
    }

    .multiples label {
        font-size: 17px;
        font-weight: 400;
        padding: 2px 10px;
        color: #f53b49;
    }

    .weekDays-selector input {
        display: none !important;
    }

    a.ui-corner-all {
        background: #ff7e7e;
        color: white;
        padding: 0;
        font-size: 15px;
    }

    li.ui-menu-item {
        width: 82px !important;
        margin: 2px !important;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 50px;
        background: #dddddd;
        height: 39px;
        width: 40px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: #f53b49;
        color: #ffffff;
    }

    label.btn.btn-primary.active {
        background: #f53b49;
    }

    /* The container */
    #editDateDiv label.btn.btn-primary {
        border-radius: 50%;
        padding: 10px;
        margin-top: 16px;
        position: relative;
        left: 30px;
        top: 9px;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radias: 50%;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .loader {
        content: '';
        display: block;
        position: fixed;
        left: 48%;
        top: 40%;
        width: 120px;
        height: 120px;
        border-style: solid;
        border-color: #f53b49;
        border-top-color: transparent;
        border-width: 16px;
        border-radius: 50%;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        z-index: 9999999;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

</style>
<style>
    .ui-timepicker-standard {
        z-index: 999999 !important;
    }

    .mt83 {
        margin-top: 83px;
    }

    .close {
        opacity: 1 !important;
    }

    .signleft-customer form a {
        font-size: 13.5px;
        color: #777;
        padding-bottom: 0;
        text-align: left;
        float: none;
    }

    .t_c {
        font-size: 13.5px !important;
        color: #777 !important;
        padding-bottom: 0;
        text-align: left;
        float: none;
    }

    button.FITNESS_ENTHUSIASTS_signup {
        margin-top: 22.4%;
    }

    .signleft {
        float: left;
        width: 45%;
    }

    .signright {
        width: 45%;
    }

    input,
    select {
        margin: 2.2% 0.5%;
        border: 1px solid #828282;
        padding: 16px 10px;
        width: 100%;
    }

    .modallink.mt20 {
        margin-top: 8% !important;
    }

    .pac-container {
        z-index: 999999999;
    }

</style>
<style>
    .dlt {
        cursor: not-allowed;
    }

    .delete_icon {
        float: right;
        color: #f53b49;
        position: relative;
        top: -20px;
    }

    span.brfcse {
        width: 36%;
        margin: 0 auto;
    }


    span.display_servicesport {
        padding-left: 0px !important;
    }

    .brfcse i.fa.fa-briefcase {
        color: #ffffff;
        font-size: 36px;
        background-color: #f53b49;
        padding: 25%;
        border-radius: 100%;
        position: relative;
        top: -47px;
    }

    .setterms {
        margin-bottom: 17px;
        padding-left: 17px;
        color: #f53b49;
    }

    #taxmsg,
    #setnumbermsg {
        padding: 5px;
        border-radius: 4px;
        text-align: left;
        border: 1px solid #f53b49;
        background: #ff7e7e;
        color: #fff;
        width: fit-content;
    }

    .textsam {
        padding: 5px;
    }

    .hrsam {
        border-top: 1px solid #dedede;
        padding: 5px 0px;
        text-align: initial;
    }

    .col-md-3.often {
        text-align: left;
        padding-left: 0px;
        padding-right: 5px;
    }

    .percentage {
        border-bottom: 1px solid;
        width: 10%;
        text-align: -webkit-right;
        padding: 2px 8px;
        border-radius: 1px;
    }

    .msesinput {
        border: 1px solid;
        padding: 10px;
        width: 30%;
        float: left;
        margin-bottom: 11px;
    }

    .m-1 {
        margin-top: 18px
    }

    .pd-0 {
        padding-left: 0;
        padding-right: 7px;
    }

    .qh-steps-form .btn.active span.glyphicon {
        color: #ffffff;
    }

    h2.additionheading {
        color: #f53b49;
        text-align: initial;
        font-size: 17px;
    }

    .col-md-3.samm,
    .col-md-6.samm,
    .col-md-12.samm {
        display: contents;
        text-align: left;
    }

    label.setupprice {
        margin-bottom: -12px;
    }

    input.offpro {
        width: unset;
        margin-right: 9px;
        margin-top: 7px;
    }

    .multiples {
        padding: 5px 0;
        text-align: left;
        font-size: 17px;
    }

    .multiples label {
        font-size: 17px;
        font-weight: 400;
        padding: 2px 10px;
        color: #f53b49;
    }

    .weekDays-selector input {
        display: none !important;
    }

    a.ui-corner-all {
        background: #ff7e7e;
        color: white;
        padding: 0;
        font-size: 15px;
    }

    li.ui-menu-item {
        width: 82px !important;
        margin: 2px !important;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 50px;
        background: #dddddd;
        height: 39px;
        width: 40px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: #f53b49;
        color: #ffffff;
    }

    label.btn.btn-primary.active {
        background: #f53b49;
    }

    /* The container */
    #editDateDiv label.btn.btn-primary {
        border-radius: 50%;
        padding: 10px;
        margin-top: 16px;
        position: relative;
        left: 30px;
        top: 9px;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radias: 50%;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .loader {
        content: '';
        display: block;
        position: fixed;
        left: 48%;
        top: 40%;
        width: 120px;
        height: 120px;
        border-style: solid;
        border-color: #f53b49;
        border-top-color: transparent;
        border-width: 16px;
        border-radius: 50%;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        z-index: 9999999;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .step-block1 h1 {
        float: left;
    }

    .calendarr {
        position: relative;
        top: -38px;
        right: -43%;
    }

    .rounded-corner {
        padding: 6px;
        padding-right: 10px;
        padding-left: 10px;
        background: red;
        color: #fff !important;
        border-radius: 30px;
        border: 1px solid red;
        cursor: hand;
        margin-bottom: 5px;
    }

    .delete-date {
        color: #fff !important;
    }

</style>

<?php 
  $address = $mydetails['zipcode'];
  $url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyC45-kgXDIY_O8SZxc5d7YLdQYqSkcts7I&address=$address&sensor=false";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response);
  
  
  //$getlat = $response->results[0]->geometry->location->lat;
 // $getlong = $response->results[0]->geometry->location->lng;
  
  ?>

<?php 
            $train_to = array(); $personality = array(); $availability = array(); $languages=array(); $travelTimes = array();$experience_level = array();$goals_option = array();$skill_lavel = array();$medical_type = array();$work_locations = array();
            //$languages  = json_decode($ProfessionalDetail->languages,true);
           // $experience_level = json_decode($ProfessionalDetail->experience_level,true);
           // $personality = json_decode($ProfessionalDetail->personality,true);
           // $goals_option = json_decode($ProfessionalDetail->goals_option,true);
           // $train_to = json_decode($ProfessionalDetail->train_to,true); 
            
            //print_r($train_to);
           // $skill_lavel = json_decode($ProfessionalDetail->skill_lavel,true); 
           // $medical_type = json_decode($ProfessionalDetail->medical_type,true); 
          //  $work_locations = json_decode($ProfessionalDetail->work_locations,true);
         //   $hours = json_decode($ProfessionalDetail->availability,true);
            ?>
<?php @$service=@$service[0];
          $login_id = Auth::user();
          @$hours = json_decode($service['serv_time_slot'],true);
            ?>
<div class="loader" style="display:block"></div>
<div class="modal-body login-pad">

    <div id="preview" style="display:none;">
        <div class="header_content" style="padding-top: 40px;">
            <img src="
          <?php echo Config::get('constants.FRONT_IMAGE'); ?>like-one.png" class="header_img">
            <h4 style="margin-left: 20px;">NICE WORK, YOUR COMPANY PROFILE IS READY FOR THE NEXT STEP!</h4>
            <p style="color: #a3a3a3;margin-left:20px;margin-top:40px">Your business profile will be submitted to the Quality Control Team for review. Check back regularly to see if your profile is accepted or not.</p>
        </div>
        <div class="user_img">
            <img src="https://www.w3schools.com/howto/img_avatar.png" class="avatar blah">
            <div class="user_img_content">
                <h4><span class="prev_firstname"></span> <span class="prev_lastname"></span></h4>
                <hr style="width: 26%;border-top: 2px solid #a3a3a3;">
                <h3 style="color:red;cursor:pointer;" onclick="$('#preview_submit').show(); $('#preview').hide()">PREVIEW PROFILE</h3>
            </div>
        </div>
        <div class="modal_buttons">
            <button type="button" onclick="$('#company_intro').show(); $('#preview').hide()" class="btn btn-secondary">EDIT FORM </button>
            <button type="button" class="btn btn-secondary s_form">SUBMIT FORM </button>
        </div>
    </div>

    <div id="preview_submit" style="display:none;">
        <div class="header_content" style="padding-top: 40px;">
            <img src="
          <?php echo Config::get('constants.FRONT_IMAGE'); ?>like-one.png" class="header_img">
            <h4 style="margin-left: 20px;">NICE WORK, YOUR company PROFILE IS READY FOR THE NEXT STEP!</h4>
            <p style="color: #a3a3a3;margin-left:20px;margin-top:40px">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the content. In publishing and graphic design.</p>
        </div>
        <div class="user_img">
            <img src="https://www.w3schools.com/howto/img_avatar.png" class="avatar blah">
            <div class="user_img_content">
                <h4><span class="prev_firstname" id="prev_firstname"></span> <span class="prev_lastname" id="prev_lastname"></span></h4>

                <hr style="width: 26%;border-top: 2px solid #a3a3a3;">
            </div>
        </div>
        <!--<div class="col-md-12" style="padding: 0;text-align: center;display: flex;justify-content: center;  margin-top: 10%;margin-bottom: 10%;">-->
        <!--        	<span class="user-img uploadedpic" style="padding: 0px;width: 150px;height: 150px;"><i class="fa fa-user"></i></span>-->
        <!--        </div>-->
        <div class="introduction_section">
            <h3 class="introduction_heading">INTRODUCTION</h3>
            <hr class="heading_hr">
            <div class="row" style="margin-top: 25px;">
                <!--<div class="col-md-6">
                First Name: <span id="prev_firstname"></span>
              </div>
              <div class="col-md-6">
                Last Name: <span id="prev_lastname"></span>
              </div>-->
                <div class="col-md-6">
                    Email: <span id="prev_email"></span>
                </div>
                <div class="col-md-6">
                    Contact: <span id="prev_contact"></span>
                </div>
            </div>
        </div>
        <hr>
        <div class="Company_section">
            <h3 class="Company_heading"> COMPANY INFORMATION</h3>
            <hr class="heading_hr">
            <div class="row" style="margin-top: 25px;">
                <div class="col-md-6 pad">
                    Company Name: <span id="prev_companyname"></span>
                </div>

                <div class="col-md-6 pad">
                    Address: <span id="prev_address"></span>
                </div>
                <div class="col-md-6 pad">
                    State: <span id="prev_state"></span>
                </div>
                <div class="col-md-6 pad">
                    City: <span id="prev_city"></span>
                </div>
                <div class="col-md-6 pad">
                    Zip Code: <span id="prev_zipcode"></span>
                </div>
                <div class="col-md-6 pad">
                    Country: <span id="prev_country"></span>
                </div>
                <br>
                <div class="col-md-6 pad">
                    EIN Number: <span id="prev_einnumber"></span>
                </div>
                <div class="col-md-6 pad">
                    Establishment Year: <span id="prev_establishmentyear"></span>
                </div>
                <div class="col-md-6 pad">
                    Business User Tag: <span id="prev_business_user_tag"></span>
                </div>
            </div>
        </div>


        <hr class="heading_education">

        <div id="heading_education" class="Education_section heading_education">
            <h3 class="Education_heading">EDUCATION EXPERIENCE</h3>
            <hr class="heading_hr">
            <div class="row" style="margin-top: 25px;">
                <div id="employment-col" class="col-md-12">
                    <h5 class="pad" style="font-weight: 500;
                font-size: 12pt;
                color: #f53b49;">Employment History Detail</h5>
                    <hr class="heading_hr" />

                    <div class="col-md-6 pad" id="prev_organisationname_col">
                        Organization Name: <span id="prev_organisationname"></span>
                    </div>
                    <div class="col-md-6 pad" id="prev_position_col">
                        Position: <span id="prev_position"></span>
                    </div>
                    <div class="col-md-6 pad" id="prev_servicestart_col">
                        Service Start: <span id="prev_servicestart"></span>
                    </div>
                    <div class="col-md-6 pad" id="prev_serviceend_col">
                        Service End: <span id="prev_serviceend"></span>
                    </div>
                </div>
                <div id="education-col" class="col-md-12">
                    <h5 class="pad" style="font-weight: 500;
    font-size: 12pt;
    color: #f53b49;">Education Detail</h5>
                    <hr class="heading_hr" />

                    <div class="col-md-6 pad" id="prev_degree_col">
                        Degree/Course: <span id="prev_degree"></span>
                    </div>
                    <div class="col-md-6 pad" id="prev_university_col">
                        University/School: <span id="prev_university"></span>
                    </div>

                    <div class="col-md-6 pad" id="prev_yeargraduate_col">
                        Completion Date: <span id="prev_yeargraduate"></span>
                    </div>
                </div>
                <div id="certification-col" class="col-md-12">
                    <h5 class="pad" style="font-weight: 500;
    font-size: 12pt;
    color: #f53b49;">Certification Detail</h5>
                    <hr class="heading_hr" />

                    <div class="col-md-6 pad" id="prev_nameofcertification_col">
                        Name of Certification: <span id="prev_nameofcertification"></span>
                    </div>
                    <div class="col-md-6 pad" id="prev_completiondate_col">
                        Skill Completion Date: <span id="prev_completiondate"></span>
                    </div>
                </div>
                <div id="skill-col" class="col-md-12">
                    <h5 class="pad" style="font-weight: 500;
    font-size: 12pt;
    color: #f53b49;">Skill, Awards and Achievement Detail</h5>
                    <hr class="heading_hr" />

                    <div class="col-md-6 pad" id="prev_skilltype_col">
                        Skill Type: <span id="prev_skilltype"></span>
                    </div>
                    <div class="col-md-6 pad" id="prev_skillcompletion_col">
                        Skill Completion Date: <span id="prev_skillcompletion"></span>
                    </div>

                    <div class="col-md-6 pad" id="prev_skilldetail_col">
                        Skill Description: <span id="prev_skilldetail"></span>
                    </div>
                </div>

            </div>

        </div>


        <hr>
        <div class="modal_buttons">
            <button type="button" onclick="$('#step6').show(); $('#preview_submit').hide()" class="btn btn-secondary">EDIT FORM </button>
            <button type="button" class="btn btn-secondary s_form">SUBMIT FORM </button>
        </div>
    </div>


    <div id="company_intro" class="" style="display:block">
        <div class="pop-title employe-title">
            <h3>Company Introduction</h3>
        </div>
        <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
        </button>
        <div class="signup">
            <div id='systemMessage'></div>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div class="clearfix"></div>
                    <p style="padding: 0px !important;text-align: left !important;"><b>Upload Picture</b></p>
                    <input class="upload-pic" type="file" name="profile_pic" id="profile_pic" class="form-control" value="{{ old('profile_pic') }}" onchange="readURL(this);">
                    <br>
                    <font style="color:red">@if ($errors->has('profile_pic')) {{$errors->first('profile_pic')}} @endif</font>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="padding-top: 11px;">
                    <span class="user-img uploadedpic"><i class="fa fa-user"></i></span>
                </div>
            </div>
            <span class="error" id="b_profile"></span>
            <div class="clearfix"></div>
            <div class="row">
                <input type="hidden" value="0" id="mybusinessid" />
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Company Representative First Name <span class="color-red">*</span></label>
                    </div>
                    <input type="text" name="firstnameb" id="b_firstname" size="30" maxlength="80" placeholder="Company Representative First Name">
                    <span class="error" id="b_fn"></span>
                </div>

                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Company Representative Last Name <span class="color-red">*</span></label>
                    </div>
                    <input type="text" name="lastnameb" id="b_lastname" size="30" maxlength="80" placeholder="Company Representative Last Name">
                    <span class="error" id="b_ln"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Email<span class="color-red">*</span></label>
                    </div>
                    <input type="email" name="emailb" id="b_email" class="myemail" autocomplete="off" size="30" placeholder="Email Address" value="{{Auth::user()->email}}" size="30" maxlength="80">
                    <span class="error b_eml" id="b_eml" style="display:none"></span>
                </div>

                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Contact Number<span class="color-red">*</span></label>
                    </div>
                    <input type="text" name="phone_number" value="{{session()->get('phone')}}" id="b_contact" size="30" placeholder="Contact No" size="30">
                    <!--oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"-->
                    <span class="error" id="b_cot"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>About Company<span class="color-red">*</span></label>
                    </div>
                    <textarea style="width:100%;" placeholder="Tell Us Somthing About Company..." name="about_company" id="about_company" rows="7" maxlength="300" required></textarea>
                    <span class="error" id="b_cot"></span>
                </div>

                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Short Description<span class="color-red">*</span></label>
                    </div>
                    <textarea style="width:100%;" placeholder="Tell Us Somthing About Company in short..." name="short_description" id="short_description" rows="4" maxlength="20" required></textarea>
                    <span class="error" id="b_short"></span>
                </div>
            </div>
            <div class="modallink mt20">
                <div class="signup-new-customer text-center">
                    <button type="button" id="company_intro_next" onclick="">Next Step</button>
                </div>
            </div>
        </div>
    </div>
    <div id="company_info" style="display:none;">
        <div class="pop-title employe-title">
            <h3>Company Information</h3>
        </div>
        <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
        </button>
        <div class="signup">
            <div id='systemMessage'></div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Company Name<span class="color-red">*</span></label>
                    </div>
                    <input type="text" value="{{session()->get('company_name')}}" name="Companyname" id="b_companyname" size="30" maxlength="80" placeholder="Company Name">
                    <span class="error " id="b_cmpo"></span>
                </div>
                <form autocomplete="off">
                    <div class="col-sm-6">
                        <div class="row col-sm-12 text-left">
                            <label>Address<span class="color-red">*</span></label>
                        </div>
                        <input autocomplete="nope" type="text" name="Address" id="b_address" oninput="initialize1(this)" placeholder="Address">
                        <span class="error " id="b_addr"></span>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>City<span class="color-red">*</span></label>
                    </div>
                    <input type="text" name="City" id="b_city" size="30" placeholder="City" size="30" maxlength="80">
                    <span class="error " id="b_ct"></span>
                </div>
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>State<span class="color-red">*</span></label>
                    </div>
                    <input type="text" name="State" id="b_state" size="30" placeholder="State" size="30" maxlength="80">
                    <span class="error " id="b_sta"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Zip Code<span class="color-red">*</span></label>
                    </div>
                    <input type="number" name="Zip Code" id="b_zipcode" size="30" placeholder="Zip Code">
                    <span class="error " id="b_zip"></span>
                </div>
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Country<span class="color-red">*</span></label>
                    </div>
                    <input type="text" name="Country" value="" id="b_country" size="30" placeholder='Country'>

                    <span class="error " id="b_cont"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>EIN Number<span class="color-red">*</span></label>
                    </div>
                    <input type="text" name="b_EINnumber" maxlength="10" id="b_EINnumber" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="EIN Number">
                    <span class="error " id="b_ein"></span>
                </div>
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Establishment Year<span class="color-red">*</span></label>
                    </div>
                    <input type="number" name="b_Establishmentyear" id="b_Establishmentyear" size="30" maxlength="4" placeholder="Establishment Year" oninput="javascript: if (this.value.length > this.maxLength || this.value > new Date().getFullYear() ) this.value = this.value.slice(0, this.maxLength);">
                    <span class="error " id="b_estb"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="row col-sm-12 text-left">
                        <label>Business User Tag<span class="color-red">*</span></label>
                    </div>
                    <input type="text" name="b_business_user_tag" id="b_business_user_tag" placeholder="Business User Tag">
                    <span class="error" id="b_usertag"></span>
                </div>
            </div>


        </div>
        <div class="signup-new-customer text-center">
            <button type="button" id="b_v_33" onclick="$('#company_info').hide();$('#company_intro').show();">Previous Step</button>
            <button type="button" id="company_info_next">Next Step</button>
        </div>
    </div>

    <div id="company_education_skill" style="display:none;">
        <div class="pop-title employe-title">
            <h3>Education & Experience</h3>
        </div>
        <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
        </button>
        <div class="signup edu-exp">
            <div id='systemMessage'></div>
            <h4 class="heading">Employment History</h4>
            <div class="row col-sm-12 text-left">
                <label>Organization Name </label>
            </div>
            <input type="text" class="frm_organization" id="frm_organisationname" name="frm_organization" placeholder="Organization name" />
            <span class="error" id="b_organisationname"></span>

            <div class="row col-sm-12 text-left">
                <label>Position </label>
            </div>
            <input type="text" id="frm_position" class="frm_position" id="frm_position" name="frm_position" placeholder="Position" />
            <span class="error" id="b_position"></span>

            <div class="qh-steps-form">
                <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary present_work_btn">
                            <input type="checkbox" autocomplete="off" name="frm_ispresentcheck" id="frm_ispresentcheck" value="1">
                            <input type="hidden" name="frm_ispresent" id="frm_ispresent" value="0">
                            <span class="glyphicon glyphicon-ok"></span>
                        </label>
                        <span>Presently working here</span> </div>
                </div>
            </div>

            <div class="row col-sm-12 text-left">
                <label>From </label>
            </div>
            <div class="row">
                <div class="col-md-12" id="dp1-position">
                    <input type="text" name="frm_servicestart" class="span2" placeholder="From" id="dp1" readonly>
                    <i class="fa fa-calendar calendarr" />
                </div>
            </div>
            <span class="error" id="b_employmentfrom"></span>

            <div class="row col-sm-12 text-left">
                <label>To </label>
            </div>
            <div class="row">
                <div class="col-md-12" id="dp2-position">
                    <input type="text" name="frm_serviceend" class="span2" placeholder="To" id="dp2" readonly>
                    <i class="fa fa-calendar calendarr" />
                </div>
            </div>
            <span class="error" id="b_employmentto"></span>
            <hr>
            <h4 class="heading">Education Details</h4>
            <div class="row col-sm-12 text-left">
                <label>Degree/Course </label>
            </div>
            <input type="text" class="frm_course" id="frm_course" name="frm_course" placeholder="Degree/Course (Obtained or Seeking)" />
            <span class="error" id="b_degree"></span>
            <div class="row col-sm-12 text-left">
                <label>University/School </label>
            </div>
            <input type="text" class="frm_university" id="frm_university" name="frm_university" placeholder="University/School" />
            <span class="error" id="b_university"></span>
            <div class="row col-sm-12 text-left">
                <label>Year Graduated</label>
            </div>
            <div class="row">
                <div class="col-md-12" id="passingpicker-position">
                    <input type="number" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:100%" class="frm_passingyear" name="frm_passingyear" placeholder="Year graduated" id="passingyear" autocomplete="off">
                </div>
            </div>
            <span class="error" id="b_year"></span>
            <hr>
            <h4 class="heading">Certification Details</h4>
            <div class="row col-sm-12 text-left">
                <label>Name of Certification </label>
            </div>
            <input type="text" name="certification" id="certification" placeholder="Name of Certification" />
            <span class="error" id="b_certification"></span>

            <div class="row col-sm-12 text-left">
                <label>Completion Date</label>
            </div>
            <div class="row">
                <div class="col-md-12" id="completionpicker-position">
                    <input type="text" style="width:100%" class="frm_passingyear" name="frm_passingyear" placeholder="Completion Date" id="completionyear" autocomplete="off">
                    <i class="fa fa-calendar calendarr" />
                </div>
            </div>
            <span class="error" id="b_certificateyear"></span>
            <hr>
            <h4 class="heading">SKILLS, ACHIEVMENTS AND AWARDS</h4>
            <div class="row col-sm-12 text-left">
                <label>Skill Type</label>
            </div>

            <select class="selectpicker my-select" id="skiils_achievments_awards1" name="skill_type" rel="notice">
                <option value="">Select Item</option>
                <option value="Skills">Skills</option>
                <option value="Achievment">Achievments</option>
                <option value="Award">Awards</option>
            </select>

            <span class="error" id="b_skilltype"></span>

            <div class="row">
                <div class="col-sm-12 text-left">
                    <label>Description</label>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control rounded-0" id="frm_skilldetail" rows="3" placeholder="Description"></textarea>
                </div>
            </div>
            <span class="error" id="b_skilldetail"></span>

            <div class="row col-sm-12 text-left my-new-date">
                <label>Completion Date</label>
            </div>
            <div class="row">
                <div class="col-md-12" id="skillcompletionpicker-position">
                    <input type="text" style="width:100%" class="frm_skillcompletion" name="skillcompletion" placeholder="Completion Date" id="skillcompletionpicker" autocomplete="off">
                    <i class="fa fa-calendar calendarr" />
                </div>
            </div>
            <span class="error" id="b_skillyear"></span>
        </div>
        <div class="modallink mt20">
            <div class="signup-new-customer text-center">
                <button type="button" onclick="$('#company_education_skill').hide();$('#company_info').show();">Previous Step</button>
                <button type="button" id="education_skill_next">Next Step</button>
            </div>
        </div>
    </div>

    <div id="step4" style="display:none;">
        <div class="pop-title employe-title">
            <h3>Step 4</h3>
        </div>
        <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
        </button>
        <div class="signup step-block1" style="width: 70%;position: relative;left: 130px;">
            <label class="step2-title">Language(s) you and your staff speak ?</label>
            <div class="sgnup-rates">
                <select name="languages[]" id="testdemo" multiple>
                    @foreach($allLanguages as $language)
                    <option value="{{$language}}">{{$language}}</option>
                    }
                    @endforeach
                </select>
                <span class="error" id="b_testdemo"></span>
                <p class="my-space-reduce">&nbsp;</p>
                <label class="step2-title">Who do you work with?</label>
                <?php $op = array("kids"=>"Kids","Teens & Adult"=>"Teens & Adult","Partners & Couples"=>"Partners & Couples","individuals"=>"Individuals","Groups"=>"Groups","all"=>"all");?>
                <select name="train_to[]" id="train_to" multiple>
                    @foreach($op as $key=> $p)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{ $key }}">{{$p}}</option>
                    @endforeach
                </select>
                <span class="error" id="b_train_to"></span>
                <p class="my-space-reduce">&nbsp;</p>
                <label class="step2-title">SERVICE Experience? (Choose all that apply)</label>
                <?php
                      $experience  = array(
                          "Technical"=>"Technical",
                          "Workout"=>"Workout",
                          "Bootcamp"=>"Bootcamp",
                          "Challenging and Tough "=>"Challenging and Tough ",
                          "Strength and Conditioning"=>"Strength and Conditioning",
                          "Learning a skill"=>"Learning a skill",
                          "Educational"=>"Educational",
                          "Adventurous"=>"Adventurous"
                        );
                      ?>
                <select name="experience_level[]" id="personality" multiple>
                    @foreach($experience as $key=> $p)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{$key}}">{{$p}}</option>
                    @endforeach
                </select>
                <span class="error" id="b_personality"></span>
                <p class="my-space-reduce">&nbsp;</p>
                <label class="step2-title">Personality Type?</label>
                <?php $type = array(
                      "An Educator & Teacher"=>"An Educator & Teacher",
                      "A Lot Of Energy"=>"A Lot Of Energy",
                      "Supportive, Soft And Nurturing"=>"Supportive, Soft And Nurturing",
                      "Tough And Firm"=>"Tough And Firm",
                      "Care About The Details"=>"Care About The Details",
                      "Drill Seargent"=>"Drill Seargent",
                      "Entertaining and Funny"=>"Entertaining and Funny"
                        );
                        ?>
                <select name="personality[]" id="personality_type" multiple>
                    @foreach($type as $key=> $p)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{$key}}">{{$p}}</option>
                    @endforeach
                </select>
                <span class="error" id="b_personality_type"></span>
                <p class="my-space-reduce">&nbsp;</p>
                <label class="step2-title">What skill level should your clients have?</label>
                <?php
                      $skills  = array(
                      "beginner"=>"Beginner",
                      "intermediated"=>"Intermediate",
                      "advanced"=>"Advanced",
                      "amateur"=>"Amateur",
                      "professional"=>"Professional",
                      "Any Experience"=>"Any Experience"
                      );
                      ?>
                <select name="skill_lavel[]" id="skill" multiple>
                    @foreach($skills as $key=> $p)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{$key}}">{{$p}}</option>
                    @endforeach
                </select>
                <span class="error" id="b_skill"></span>
                <p class="my-space-reduce">&nbsp;</p>
                <label class="step2-title">Do you work with clients with medical conditions?</label>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                        <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary medicaloption">
                                    <input type="radio" value="1" class="chkdy" name="medical_states" autocomplete="off">
                                    <span class="glyphicon glyphicon-ok"></span> </label>
                                Yes
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                        <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary medicaloption">
                                    <input type="radio" value="0" class="chkdy" name="medical_states" autocomplete="off">
                                    <span class="glyphicon glyphicon-ok"></span> </label>
                                No
                            </div>
                        </div>
                    </div>
                </div>
                {{-- start  --}}
                <div class="medicalyesno" style=" display: none;">
                    <label class="step2-title text-left" style="text-transform: none;">If Yes, what type? </label>
                    <div class="">
                        <?php $medicalCondition = array('Breathing Problem','Back Problem','Pregnant','Special Needs','Doesnt Matter','Others'); ?>
                        <select name="medical_type[]" id="mcc" multiple>
                            @foreach($medicalCondition as $key => $mcc)
                            <?php $key = str_replace(' ','_',strtolower($key)); ?>
                            <option value="{{$key}}">{{$mcc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="error" id="b_mcc"></span>
                </div>
                {{-- end  --}}
                <p class="my-space-reduce">&nbsp;</p>
                <label>WHERE DO YOU WORK WITH CLIENTS? (Choose all that apply)
                </label>
                <?php
                      $clients_option  = array(
                           "Online"=>"Online",                  
                           "Studio"=>"Studio",                  
                           "Local Gym"=>"Local Gym",
                       "Training Facility"=>"Training Facility",
                       "Public location"=>"Public location",
                       "Outside location"=>"Outside location",
                       "Indoor facility"=>"Indoor facility",
                       "Clients home OR Apartment"=>"Clients home OR Apartment",
                       "A location chosen by the client"=>"A location chosen by the client",
                       "Other"=>"Other",
                       "Any location"=>"Any location",
                      
                      );
                       ?>
                <select name="work_locations[]" id="where_choose" multiple>
                    @foreach($clients_option as $key => $mcc)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{$key}}">{{$mcc}}</option>
                    @endforeach
                </select>
                <span class="error" id="b_where_choose"></span>
            </div>
            <p class="my-space-reduce">&nbsp;</p>
            <label class="step2-title">Does your business help clients with fitness goals? If so, select options.?</label>
            <div class="row">
                <div class=" qh-steps-form">
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                        <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary fitgolsop">
                                    <input type="radio" value="1" class="chkdy" name="fitness_goals" autocomplete="off">
                                    <span class="glyphicon glyphicon-ok"></span> </label>
                                Yes
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                        <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary fitgolsop">
                                    <input type="radio" value="0" class="chkdy" name="fitness_goals" autocomplete="off">
                                    <span class="glyphicon glyphicon-ok"></span> </label>
                                No
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end row  --}}
                <span class="fitgolsyesno" style="display: none;">
                    <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form">
                        <label class="step2-title text-left" style="text-transform: none;">If Yes, what type? </label>
                        <?php $fitness_goals_array = array('Weight Loss','Firming & Toning','Increase Strenght','Endurance Training','Nutritions','Weight Gain','Flexibilty','Aerobics Fitness','Body Building','Pre/Post Natal','Other'); ?>
                        <select name="goals_option[]" id="fitness_goals_array" multiple>
                            @foreach($fitness_goals_array as $fga)
                            <?php $key = str_replace(' ','_',strtolower($fga)); ?>
                            <option value="{{$key}}">{{$fga}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="error" id="b_fitness_goals_array"></span>
                </span>
                {{-- end span  --}}
            </div>


        </div>
        <div class="modallink mt20">
            <div class="signup-new-customer text-center">
                <button type="button" onclick="$('#company_education_skill').show();$('#step4').hide();">Previous Step</button>
                <button type="button" id="step4_next">Next Step</button>
            </div>
        </div>
    </div>

    <div id="step5" style="display:none;">
        <div class="pop-title employe-title">
            <h3>Step 5</h3>
        </div>
        <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
        </button>
        <div class="signup step-block1">
            <h1 class="step2-title">Add your Business Hours</h1>
            <div class="signup-block">
                <h3 class="step2-title">Add your business hours to Valor Mixed Martial Arts NYC, so its easy to people to plan a visit. When you add business hours, Your page is also more likely to be suggested to people in your area.</h3>
                <div class="sgnup-rates mrgn-md-top">
                    <div class="row">
                        <h4 style="margin-left:10px">Hours</h4>
                        <br>
                        <?php 
                    $businessHoursType = array ('Open on selected hours','Always Open','No hours available','Permanently Closed');
                    foreach ($businessHoursType as $bkey => $bval) { ?>
                        <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                            <div class="form-control">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="business_hour_type btn btn-primary " onclick="javascript:hoursshow();" onclick="javascript:hidehoursshow();">
                                        <input type="radio" class="chk" value="<?php echo $bkey; ?>" name="hours_opt" autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span> </label>
                                    <?php echo $bval; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div id="hourshow" style="display:none">
                        <hr />
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                                <div class="form-control">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary" onclick="javascript:hoursshow();">
                                            <input type="radio" class="chk" value="anyday" name="business_hour_supertype" autocomplete="off">
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                        Specific Day or Time
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                                <div class="form-control">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary" onclick="javascript:showEditDate();">
                                            <input type="radio" class="chk" value="mubusinesshour" name="business_hour_supertype" autocomplete="off">
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                        My business hours
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- div classs hourshow end  --}}
                    <div class="row" id="hoursshow" style="display:none">
                        <!--  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        Sunday
                      </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        Monday
                      </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        Tuesday
                      </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        Wednesday
                      </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        Thursday
                      </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        Friday
                      </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        Saturday
                      </div>
                    </div>
                  </div> -->
                        <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form">
                            <div class="form-control">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="btn-group" data-toggle="buttons">
                                            Sunday
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bsunstarttimepicker" name="availability[sunday_start]" value="{{$hours['sunday_start']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                    <div class="col-md-1 col-sm-1"> &nbsp;-&nbsp;</div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bsunendtimepicker" name="availability[sunday_end]" value="{{$hours['sunday_end']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                </div>
                            </div>
                            <div class="form-control">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="btn-group" data-toggle="buttons">
                                            Monday
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bmonstarttimepicker" name="availability[monday_start]" value="{{$hours['monday_start']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                    <div class="col-md-1 col-sm-1"> &nbsp;-&nbsp;</div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bmonendtimepicker" name="availability[monday_end]" value="{{$hours['monday_end']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                </div>

                            </div>
                            <div class="form-control">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="btn-group" data-toggle="buttons">
                                            Tuesday
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="btuesstarttimepicker" name="availability[tuesday_start]" value="{{$hours['tuesday_start']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                    <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="btuesendtimepicker" name="availability[tuesday_end]" value="{{$hours['tuesday_end']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                </div>

                            </div>
                            <div class="form-control">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="btn-group" data-toggle="buttons">
                                            Wednesday
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bwedstarttimepicker" name="availability[wednesday_start]" value="{{$hours['wednesday_start']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                    <div class="col-md-1 col-sm-1"> &nbsp;-&nbsp;</div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bwedendtimepicker" name="availability[wednesday_end]" value="{{$hours['wednesday_end']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                </div>
                            </div>
                            <div class="form-control">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="btn-group" data-toggle="buttons">
                                            Thursday
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bthrusstarttimepicker" name="availability[thrusday_start]" value="{{$hours['thrusday_start']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                    <div class="col-md-1 col-sm-1"> &nbsp;-&nbsp;</div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bthrusendtimepicker" name="availability[thrusday_end]" value="{{$hours['thrusday_end']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                </div>
                            </div>
                            <div class="form-control">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="btn-group" data-toggle="buttons">
                                            Friday
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bfristarttimepicker" name="availability[friday_start]" value="{{$hours['friday_start']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                    <div class="col-md-1 col-sm-1"> &nbsp;-&nbsp;</div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bfriendtimepicker" name="availability[friday_end]" value="{{$hours['friday_end']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                </div>
                            </div>
                            <div class="form-control">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="btn-group" data-toggle="buttons">
                                            Saturday
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bsatstarttimepicker" name="availability[saturday_start]" value="{{$hours['saturday_start']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                    <div class="col-md-1 col-sm-1"> &nbsp;-&nbsp;</div>
                                    <div class="col-md-3" style="">
                                        <input type="text" class="bsatendtimepicker" name="availability[saturday_end]" value="{{$hours['saturday_end']}}" autocomplete="off" style=" width:100%">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Time Zone</h1>
                                </div>
                                <div class="col-md-6">
                                    <select name="timezone" id="timezone" class="form-control">
                                        <option value="est"> Eastern Standard Time (EST)</option>
                                        <option value="cst"> Central Standard Time (CST)</option>
                                        <option value="mst"> Mountain Standard Time (MST)</option>
                                        <option value="pst"> Pacific Standard Time (PST)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div style="width: 90%;float: inherit;border-radius: 4px;margin: 20px 10px 10px 10px;">
                            <div id="editDateDiv" style="width: 90%;margin-left: 10px;display: none;">
                                <p>What are your business hours?</p>
                                <br>
                                <p>Which days do you work?</p>
                                <br>
                                <div class="weekDays-selector">
                                    <input type="checkbox" id="weekday-sun" class="weekday" />
                                    <label for="weekday-sun">S</label>
                                    <input type="checkbox" id="weekday-mon" class="weekday" />
                                    <label for="weekday-mon">M</label>
                                    <input type="checkbox" id="weekday-tue" class="weekday" />
                                    <label for="weekday-tue">T</label>
                                    <input type="checkbox" id="weekday-wed" class="weekday" />
                                    <label for="weekday-wed">W</label>
                                    <input type="checkbox" id="weekday-thu" class="weekday" />
                                    <label for="weekday-thu">T</label>
                                    <input type="checkbox" id="weekday-fri" class="weekday" />
                                    <label for="weekday-fri">F</label>
                                    <input type="checkbox" id="weekday-sat" class="weekday" />
                                    <label for="weekday-sat">S</label>
                                </div>
                                {{-- <div style="line-height: 3;">
                        <p>What hours are you normally available to work?</P>
                        <input class="form-control timepicker" type="text" name="to" value="">
                        To 
                        <input class="form-control timepicker" type="text" name="to" id="timepicker1" value=""> 
                        <script type="text/javascript">
                          $('#timepicker1').timepicker({
                            showInputs: false
                          });
                        </script>
                      </div>  --}}
                            </div>
                        </div>
                        <hr />
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form">
                            <div class="form-control">
                                <h4>Any Special Days Off?</h4>
                                <br />
                                <div class="manual-remove" style="float:left;">

                                </div>

                                <div class="btn-group" data-toggle="buttons">
                                    <input type="text" class="form-control" name="special_days_off" placeholder="Click here to select the dates you are closed" id="mdp-demo" onkeydown="no_backspaces(event);" />
                                    <!--    <button type="button"  class="button-nxt button-next" id="markcalendar">Mark Calender</button>-->
                                </div>
                            </div>
                        </div>
                        {{--
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <h4>Repeat Every Year</h4>
                    <br/>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                        <input type="radio" class="chk" value="test2" name="repeat_year" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                        Yes
                      </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                        <input type="radio" class="chk" value="test13" name="repeat_year" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                        No
                      </div>
                    </div>
                  </div>
                  --}}
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 style="text-align: left">How much notice do you need for each booking?</h3>
                        </div>
                    </div>
                    <div class="row qh-steps-form-cstm">
                        <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form ">
                            <div class="form-control">
                                <div class="select-style">
                                    <?php $note = [];?>

                                    <select class="selectpicker" name="notice_each_book_day" id="firstdayweek" rel="notice">
                                        <option values="Days" @if(@array_key_exists("Days",$note)) selected @endif>Days</option>
                                        <option values="Weeks" @if(@array_key_exists("Weeks",$note)) selected @endif>Weeks</option>
                                        <option values="Months" @if(@array_key_exists("Months",$note)) selected @endif>Months</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                            <div class="form-control">
                                <div class="select-style">
                                    <select class="selectpicker" name="notice_each_book_ans" id="notice">
                                        @for ($i = 1; $i <= 31; $i++) <option values="{{$i}}" @if(@in_array($i,array_values($note))) selected @endif>{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 style="text-align: left">How far in advance can a customer book/reserve?</h3>
                        </div>
                    </div>
                    <?php $addv = [];?>
                    <div class="row qh-steps-form-cstm">
                        <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                            <div class="form-control">
                                <div class="select-style">
                                    <select class="selectpicker" name="advance_book_day" id="secdayweek" rel="addvance">
                                        <option values="Days" @if(@array_key_exists("Days",$addv)) selected @endif>Days</option>
                                        <option values="Weeks" @if(@array_key_exists("Weeks",$addv)) selected @endif>Weeks</option>
                                        <option values="Months" @if(@array_key_exists("Months",$addv)) selected @endif>Months</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                            <div class="form-control">
                                <div class="select-style">
                                    <select class="selectpicker" name="advance_book_ans" id="addvance">
                                        @for ($i = 1; $i <= 31; $i++) <option values="{{$i}}" @if(@in_array($i,array_values($addv))) selected @endif>{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modallink mt20">
                    <div class="signup-new-customer text-center">
                        <button type="button" onclick="$('#step5').hide();$('#step4').show();">Previous Step</button>
                        <button type="button" id="spcl_btn">Next Step</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addServiceEditModal" style="display:none;">

    </div>

    <div id="step6" style="display:none;">
        <div class="pop-title employe-title">
            <h3>Step 6</h3>
        </div>
        <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
        </button>
        <div class="signup step-block1">

            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                    <label style="float:left;">Willing to travel</label>
                    <div class="clearfix"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                        <div class="form-control">

                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary willing_to_travel active">
                                    <input type="radio" value="yes" class="chkdy" name="willing_to_travel" autocomplete="off" checked>
                                    <span class="glyphicon glyphicon-ok"></span> </label>
                                Yes
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                        <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary willing_to_travel">
                                    <input type="radio" value="no" class="chkdy" name="willing_to_travel" autocomplete="off">
                                    <span class="glyphicon glyphicon-ok"></span> </label>
                                No
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                        <span class="travel_miles_div">
                            <p class="para-sec">How far are you willing to travel out of your zip code to work with clients?</p>
                            <div class="select-style">
                                <?php
                            $miles_arr = array('1'=>'1 Mile','3'=>'3 Miles','5'=>'5 Miles','10'=>'10 Miles','15'=>'15 Miles','20'=>'20 Miles');
                            ?>
                                <select class="selectpicker" name="travel_miles" id="milesnew">
                                    <?php foreach($miles_arr as $key=>$value) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div id="map_canvas" style="height:300px;width:700px"></div>
                        </span>
                    </div>
                </div>
            </div>
            <h1>
                <div style="border: 2px solid #dad5d599;height: 7px;border-style: inset;margin-bottom: 20px;"></div>
                <p style="color: red">YOU’RE ALMOST DONE:</p>
                SET YOUR BUSINESS SERVICES AND PRICES
            </h1>
            <div class="signup-block signup-block1">

                <h3>What service or activity do you offer your clients?</h3>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center service-icon">
                        <span class="user-img" style="overflow:inherit;">
                            <i class="fa fa-briefcase"></i>
                            <a href="#" class="add_sngp" id="add_service">+</a>
                        </span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 text-left ">
                        <p>This last section is where you will describe your programs, place images, description, prices, taxes, terms and conditions, contracts, one-time payments, recurring payment, sessions, create tours, and more.<br>Make sure your prices are competitive to your skill level. Add an attractive description and images that best represents your program. </p>
                    </div>
                </div>
            </div>
            <!--ALMOST DONE end -->
            <!services sections -->
                <div class="services-block">
                    <div class="row" id="service_div">

                    </div>
                </div>
                <!--  </div>-->
                <!--</div>-->
        </div>
        <div class="modallink mt20">
            <div class="signup-new-customer text-center">
                <button type="button" onclick="$('#step6').hide();$('#step5').show();">Previous Step</button>
                <button type="button" id="step6_next" onclick="">Next Step</button>
            </div>
        </div>
    </div>
    <div id="addServiceModal" style="display:none;">
        <div class="pop-title employe-title">
            <h3 id="service_new">Add Your Program</h3>
        </div>
        <button type="button" class="close modal-close" onclick="$('#addServiceModal').hide();$('#step6').show();removeServiceForm();">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
        </button>
        <div class="signup">
            <div id='systemMessage_service'></div>
            <!--start mayankstep1-->
            <div id="mayankstep1" class="addprogram-wrapper">
                <div class="pop-title1 employe-title">
                    <!--<h3 style="font-size: 41px;">Add Your Program</h3>-->
                </div>
                <div class="emplouyee-form">
                    <div class="select-style review-select2">
                        <select name="frm_servicesport" id="frm_servicesport" class="selectpicker">
                            {!! $sports_select !!}
                        </select>
                    </div>
                    <input type="text" name="frm_servicetitle" id="frm_servicetitle" placeholder="Name of Program" title="servicetitle" value="{{$service['title']}}" />
                    <!--<div class="row">-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <input type="text" placeholder="Time Spot From" class="timepicker" name="frm_servicetimeslotfrom" value="{{$service['timeslot_from']}}" autocomplete="off" style="width:100%">-->
                    <!--    </div>-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <input type="text" placeholder="Time Spot To" class="timepicker" name="frm_servicetimeslotto" value="{{$service['timeslot_to']}}" autocomplete="off" style="width:100%">-->
                    <!--    </div>-->
                    <!--</div>-->


                </div>

                <div class="emplouyee-form hrsam">
                    <div class="row">
                        <div class="col-md-12 addbrowse-pic">
                            <p> <b>Upload an image that best represents your program.</b> (Uploading a professional image of your program will appear on your profile and increase your chances of being picked by customers.)
                            </p>
                            <input type="hidden" name="old_profile_pic" id="old_profile_pic" title="old_profile_pic">
                            <input type="hidden" name="updated_profile_pic" id="updated_profile_pic" title="updated_profile_pic">
                            <input class="upload-pic" type="file" name="frm_profile_pic" id="frm_profile_pic" class="form-control" title="profile_pic" value="{{ old('image') }}" onchange="readURL1(this)" style="width:84%;">
                            <br>
                            <font style="color:red">@if ($errors->has('profile_pic')) {{$errors->first('profile_pic')}} @endif</font>
                            <span class="user-img uploadedpic1" style="margin-left: 13px;width: 75px;height: 75px"><i class="fa fa-user" style="line-height: 56px;"></i></span>
                        </div>

                        <div class="col-md-12">
                            <div class="icondoller-wrap">
                                <span class="dollar-span" style="display:none;">$</span>
                                <input type="number" placeholder="price($)" oninput="var j = $(this).val();if(j == ''){$('.dollar-span').hide();}else{$('.dollar-span').show();}" name="frm_serviceprice" onchange="var j = $(this).val();var k = j.split('.');$(this).val(parseFloat(k[0]).toFixed(2));" id="frm_serviceprice" value="${{str_replace('$','',$service['price'])}}" title="serviceprice" style="margin-top: 15px;">
                            </div>
                            <textarea name="frm_servicedesc" id="frm_servicedesc" placeholder="Program Description">{{$service['servicedesc']}}</textarea>

                        </div>
                        <!--   <textarea name="frm_tcdesc" id="frm_tcdesc" placeholder="Terms and Conditions for this program" required></textarea>-->
                    </div>
                </div>

                <div>
                    <span class="step active"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
                <div class="modallink mt20">
                    <div class="signup-new-customer text-center">
                        <button type="button" onclick="$('#step6').show();$('#addServiceModal').hide();">Previous Step</button>
                        <button type="button" id="stepbtn1" class="stepbtn" href="#" onclick="$('#mayankstep1').hide();$('#mayankstep2').show();$('#mayankstep3').hide();">NEXT</button>
                    </div>
                </div>

                {{-- additional option  --}}
                <div id="taxmsg" style="display:none"></div>
                <br>

                <!--end mayankstep1-->
            </div>






            <!--start mayankstep2-->
            <div id="mayankstep2" style="display: none;">
                <div class="pop-title2 employe-title">
                    <!-- <h3 style="font-size: 26px;">Tell us more about your services</h3>-->
                </div>
                <!--- timing -->
                <!--                  <div class="row">-->
                <!--    <div class="col-md-6">-->
                <!--            <div class="form-control">-->
                <!--                <div class="btn-group" data-toggle="buttons">-->
                <!--                Sunday-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="btn-group" data-toggle="buttons">-->
                <!--                Monday-->
                <!--              </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--                <div class="btn-group" data-toggle="buttons">-->
                <!--                Tuesday-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="btn-group" data-toggle="buttons">-->
                <!--                Wednesday-->
                <!--              </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--                <div class="btn-group" data-toggle="buttons">-->
                <!--                Thursday-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="btn-group" data-toggle="buttons">-->
                <!--                Friday-->
                <!--              </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="btn-group" data-toggle="buttons">-->
                <!--                Saturday-->
                <!--              </div>-->
                <!--            </div>-->
                <!--    </div>-->
                <!--    <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">-->
                <!--            <div class="form-control">-->
                <!--                <div class="col-md-5" >-->
                <!--                    <input type="text"  class="timepicker" name="hours[sunday_start]" value="{{$hours['sunday_start']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--                </div>-->
                <!--                <div class="col-sm-1"> &nbsp;-&nbsp;</div>-->
                <!--                <div class="col-md-5" style="border:1px solid #555;" >   -->
                <!--                    <input type="text" class="timepicker" name="hours[sunday_end]" value="{{$hours['sunday_end']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >-->
                <!--                <input type="text" class="timepicker" name="hours[monday_start]" value="{{$hours['monday_start']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--              <div class="col-sm-1"> &nbsp;-&nbsp;</div>-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >   -->
                <!--                <input type="text" class="timepicker" name="hours[monday_end]" value="{{$hours['monday_end']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >-->
                <!--                <input type="text" class="timepicker" name="hours[tuesday_start]" value="{{$hours['tuesday_start']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--              <div class="col-sm-1"> &nbsp;-&nbsp;</div>-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >   -->
                <!--                <input type="text" class="timepicker" name="hours[tuesday_end]" value="{{$hours['tuesday_end']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >-->
                <!--                <input type="text" class="timepicker" name="hours[wednesday_start]" value="{{$hours['wednesday_start']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--              <div class="col-sm-1"> &nbsp;-&nbsp;</div>-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >   -->
                <!--                <input type="text" class="timepicker" name="hours[wednesday_end]" value="{{$hours['wednesday_end']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >-->
                <!--                <input type="text" class="timepicker" name="hours[thursday_start]" value="{{$hours['thursday_start']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--              <div class="col-sm-1"> &nbsp;-&nbsp;</div>-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >   -->
                <!--                <input type="text" class="timepicker" name="hours[thursday_end]" value="{{$hours['thursday_end']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >-->
                <!--                <input type="text" class="timepicker" name="hours[friday_start]" value="{{$hours['friday_start']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--              <div class="col-sm-1"> &nbsp;-&nbsp;</div>-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >   -->
                <!--                <input type="text" class="timepicker" name="hours[friday_end]" value="{{$hours['friday_end']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--            </div>-->
                <!--            <div class="form-control">-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >-->
                <!--                <input type="text" class="timepicker" name="hours[saturday_start]" value="{{$hours['saturday_start']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--              <div class="col-sm-1"> &nbsp;-&nbsp;</div>-->
                <!--              <div class="col-md-5" style="border:1px solid #555;" >   -->
                <!--                <input type="text" class="timepicker" name="hours[satureay_end]" value="{{$hours['satureay_end']}}" autocomplete="off" style="border:none; width:100%">-->
                <!--              </div>-->
                <!--            </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!-- end timing -->



                <div class="row">
                    <div class="col-md-12">
                        <div class="emplouyee-form">

                            <div class="multiples">
                                <label>Choose Provider Type</label>
                                <select name="frm_servicetype[]" id="categ" multiple>
                                    @foreach ($businessType as $bkey => $bval)
                                    <?php $servicetype = json_decode($service['servicetype'],true);
                          ?>
                                    <option value='{{$bkey}}'> {{$bval->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiples">
                                <label>Activity Designed For</label>
                                <select name="activitydesignsfor[]" id="activitydesigned" multiple>
                                    @foreach ($activity as $pkey => $pval)
                                    <?php $pkey = str_replace(' ','_',strtolower($pkey)); 
                          $activitydesignsfor = json_decode($service['activitydesignsfor'],true);
                          ?>
                                    <option value='{{$pkey}}' @if(@in_array($pkey,$activitydesignsfor)) selected @endif> {{$pval}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiples">
                                <label>Choose Activity Type </label>
                                <select name="activitytype[]" id="activitytype" multiple>
                                    @foreach ($programType as $pkey => $pval)
                                    <?php $pkey = str_replace(' ','_',strtolower($pkey)); 
                         $activitytype = json_decode($service['activitytype'],true);?>
                                    <option value='{{$pkey}}' @if(@in_array($pkey,$activitytype)) selected @endif> {{$pval}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiples">
                                <label>Age Range</label>
                                <select name="frm_agerange[]" id="frm_agerange" multiple>
                                    @foreach ($ageRange as $arkey => $arval)
                                    <?php $arkey = str_replace(' ','_',strtolower($arkey)); 
                         $agerange = json_decode($service['agerange'],true);
                         ?>
                                    <option value='{{$arkey}}' @if(@in_array($arkey,$agerange)) selected @endif> {{$arval}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiples">
                                <label>Activity For?</label>
                                <select name="frm_programfor[]" id="frm_programfor" multiple>
                                    @foreach ($programFor as $pfkey => $pfval)
                                    <?php $pfkey = str_replace(' ','_',strtolower($pfkey));
                         $programfor = json_decode($service['programfor'],true);
                          ?>
                                    <option value='{{$pfkey}}' @if(@in_array($pfkey,$programfor)) selected @endif> {{$pfval}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiples">
                                <label>Participates Number</label>
                                <select name="frm_numberofpeople[]" id="frm_numberofpeople">
                                    @foreach ($numberOfPeople as $npkey => $npval)
                                    <?php $npkey = str_replace(' ','_',strtolower($npkey)); 
                         $numberofpeople = json_decode($service['numberofpeople'],true);
                         ?>
                                    <option value='{{$npkey}}' @if(@in_array($npkey,$numberofpeople)) selected @endif> {{$npval}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiples">
                                <label>Program Experience Level</label>
                                <select name="frm_experience_level[]" id="frm_experience_level" multiple>
                                    @foreach ($expLevel as $elkey => $elval)
                                    <?php 
                         $experience_level = json_decode($service['experience_level'],true);
                         ?>
                                    <option value='{{$elkey}}' @if(@in_array($elkey,$experience_level)) selected @endif> {{$elval}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiples">
                                <label>Teaching Style</label>
                                <select name="frm_teachingstyle[]" id="teaching" multiple>
                                    @foreach ($teaching as $elkey => $elval)
                                    <?php 
                         $frm_teachingstyle = json_decode($service['frm_teachingstyle'],true);
                         ?>
                                    <option value='{{$elkey}}' @if(@in_array($elkey,$frm_teachingstyle)) selected @endif> {{$elval}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiples">
                                <label>Activity Location</label>
                                <select name="frm_servicelocation[]" id="frm_servicelocation" multiple>
                                    @foreach ($serviceLocation as $slkey => $slval)
                                    <?php $slkey = str_replace(' ','_',strtolower($slkey));
                         $servicelocation = json_decode($service['servicelocation'],true);
                         ?>
                                    <option value='{{$slkey}}' @if(@in_array($slkey,$servicelocation)) selected @endif>{{$slval}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiples">
                                <label>Activity Experience</label>
                                <select name="frm_servicefocuses[]" id="frm_servicefocuses" multiple>
                                    @foreach ($pFocuses as $pfkey => $pfval)
                                    <?php $pfkey = str_replace(' ','_',strtolower($pfkey)); 
                          $focuses = json_decode($service['focuses'],true);
                          ?>
                                    <option value='{{$pfkey}}' @if(@in_array($pfkey,$focuses)) selected @endif> {{$pfval}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>

                            </div>

                        </div>
                    </div>
                </div>










                <div>
                    <span class="step"></span>
                    <span class="step active"></span>
                    <span class="step"></span>
                </div>
                <div class="modallink mt20">
                    <div class="signup-new-customer text-center">
                        <button type="button" class="stepbtn" href="#" onclick="$('#mayankstep1').show();$('#mayankstep2').hide();$('#mayankstep3').hide();$('#mayankstepwhere').hide();$('#service_new').text('Add Your Programs'); ">PREVIOUS</button>
                        <button type="button" id="stepbtn2" class="stepbtn" href="#" onclick="$('#mayankstep1').hide();$('#mayankstep2').hide();$('#mayankstep3').hide();$('#mayankstepwhere').show();">NEXT</button>
                    </div>
                </div>

            </div>
            <br>
            <!--end mayankstep2-->


            <!---- statr where when -->

            <div id="mayankstepwhere" style="display: none;">
                <div class="pop-title2 employe-title">
                    <!--<h3 style="font-size: 26px;">Where and When</h3>-->
                </div>
                <div>


                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-left">Where and When</h4>
                            <label class="text-left">Class Meets</label>
                            <select name="frm_class_meets" id="frm_class_meets">
                                <option value="Weekly">Weekly</option>
                                <option value="On a specific day">On a specific day</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-left">Starting</label>
                                    <div class="row">
                                        <div class="col-md-12" id="startingpicker-position">
                                            <input type="text" style="width:100%" class="frm_starting" name="starting" placeholder="Starting" id="startingpicker" autocomplete="off">
                                            <i class="fa fa-calendar calendarr" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 schedule_until_box">
                                    <input type="hidden" id="end_date" />
                                    <label class="text-left">Schedule Until</label>
                                    <select name="frm_schedule_until" id="frm_schedule_until">
                                        <option value="1 Month">1 Month</option>
                                        <option value="3 Months">3 Months</option>
                                        <option value="6 Months">6 Months</option>
                                        <option value="9 Months">9 Months</option>
                                        <option value="12 Months">12 Months</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mymy" style="display:none;">
                            <div class="day-time-div-main">
                                <div class="day-time-div">
                                    <div class="row">
                                        <div class="col-sm-1 day_circle Sunday dys">
                                            <p>Su</p>
                                        </div>
                                        <div class="col-sm-1 day_circle Monday dys">
                                            <p>Mo</p>
                                        </div>
                                        <div class="col-sm-1 day_circle Tuesday dys">
                                            <p>Tu</p>
                                        </div>
                                        <div class="col-sm-1 day_circle Wednesday dys">
                                            <p>We</p>
                                        </div>
                                        <div class="col-sm-1 day_circle Thrusday dys">
                                            <p>Th</p>
                                        </div>
                                        <div class="col-sm-1 day_circle Friday dys">
                                            <p>Fr</p>
                                        </div>
                                        <div class="col-sm-1 day_circle Saturday dys">
                                            <p>Sa</p>
                                        </div>
                                    </div>
                                    <div class="wrapperow">
                                        <div class="form-control sunday_start" style="display:none;margin-top:10px;">
                                            <div class="row">
                                                <label class="col-sm-12">Sunday Time</label><br />
                                                <div class="col-sm-5">
                                                    <input type="text" class="sunquicktimepicker" name="hours[sunday_start]" value="{{$hours['sunday_start']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                                <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="timepicker" name="hours[sunday_end]" value="{{$hours['sunday_end']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-control monday_start" style="display:none;margin-top:10px;">
                                            <div class="row">
                                                <label class="col-md-12">Monday Time</label><br />
                                                <div class="col-sm-5">
                                                    <input type="text" class="monquicktimepicker" name="hours[monday_start]" value="{{$hours['monday_start']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                                <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="timepicker" name="hours[monday_end]" value="{{$hours['monday_end']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-control tuesday_start" style="display:none;margin-top:10px;">
                                            <div class="row">
                                                <label class="col-md-12">Tuesday Time</label><br />
                                                <div class="col-sm-5">
                                                    <input type="text" class="tuesquicktimepicker" name="hours[tuesday_start]" value="{{$hours['tuesday_start']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                                <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="timepicker" name="hours[tuesday_end]" value="{{$hours['tuesday_end']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-control wednesday_start" style="display:none;margin-top:10px;">
                                            <div class="row">
                                                <label class="col-md-12">Wednesday Time</label><br />
                                                <div class="col-sm-5">
                                                    <input type="text" class="wedquicktimepicker" name="hours[wednesday_start]" value="{{$hours['wednesday_start']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                                <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="timepicker" name="hours[wednesday_end]" value="{{$hours['wednesday_end']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-control thrusday_start" style="display:none;margin-top:10px;">
                                            <div class="row">
                                                <label class="col-md-12">Thursday Time</label><br />
                                                <div class="col-sm-5">
                                                    <input type="text" class="thrusquicktimepicker" name="hours[thrusday_start]" value="{{$hours['thrusday_start']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                                <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="timepicker" name="hours[thrusday_end]" value="{{$hours['thrusday_end']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-control friday_start" style="display:none;margin-top:10px;">
                                            <div class="row">
                                                <label class="col-md-12">Friday Time</label><br />
                                                <div class="col-sm-5">
                                                    <input type="text" class="friquicktimepicker" name="hours[friday_start]" value="{{$hours['friday_start']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                                <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="timepicker" name="hours[friday_end]" value="{{$hours['friday_end']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-control saturday_start" style="display:none;margin-top:10px;">
                                            <div class="row">
                                                <label class="col-md-12">Saturday Time</label><br />
                                                <div class="col-sm-5">
                                                    <input type="text" class="satquicktimepicker" name="hours[saturday_start]" value="{{$hours['saturday_start']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                                <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="timepicker" name="hours[saturday_end]" value="{{$hours['saturday_end']}}" autocomplete="off" style=" width:100%">
                                                </div>
                                            </div>
                                        </div>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn btn-primary add-another-time">Add Another Time</button>
                            </div>
                        </div>

                    </div>

                    <div class="modallink mt20">
                        <div class="signup-new-customer text-center">
                            <button type="button" class="stepbtn" href="#" onclick="$('#mayankstep1').hide();$('#mayankstep2').show();$('#mayankstep3').hide();$('#mayankstepwhere').hide()">PREVIOUS</button>
                            <button type="button" id="stepbtnwhen" class="stepbtn" href="#" onclick="$('#mayankstep1').hide();$('#mayankstep2').hide();$('#mayankstepwhere').hide();$('#mayankstep3').show();">NEXT</button>
                        </div>
                    </div>
                </div>
            </div>

            <!---- end where when -->




            <!--start mayankstep3-->
            <div id="mayankstep3" style="display: none;">
                <div class="pop-title3 employe-title">
                    <!--<h3 style="font-size: 41px;">Setup your payments</h3>-->
                </div>
                <div class="multiples">
                    <h3>Set Up Your Pricing </h3>

                    <label>Is this a special offer or a promotion ?</label>
                    <br>
                    <label class="setupprice">
                        <input type="radio" value="1" class="chkdy offpro" name="setupprice" autocomplete="off" @if($service['setupprice']==1) checked @endif>
                        <span class="promo">Yes</span>
                    </label>
                    <label class="setupprice">
                        <input type="radio" value="0" class="chkdy offpro" name="setupprice" autocomplete="off" @if($service['setupprice']==0) checked @endif>
                        <span class="promo">No</span>
                    </label>
                </div>
                <div class="multiples step2multiples" id="offprom_option" @if($service['setupprice']==0) style="display: none;" @endif>

                    <select name="frm_specialdeals[]" id="frm_specialdeals" multiple>
                        @foreach ($specialDeals as $pfkey => $pfval)specialdeals
                        <?php $pfkey = str_replace(' ','_',strtolower($pfkey)); 
                          $servicepriceoption =json_decode($service['specialdeals'],true);
                          ?>
                        <option value='{{$pfkey}}' @if(@in_array($pfkey,$servicepriceoption)) selected @endif> {{$pfval}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="multiples step2multiples">
                    <label>Service Price Options</label>
                    <select name="frm_servicepriceoption[]" id="frm_servicepriceoption" multiple>
                        @foreach ($servicePriceOption as $pfkey => $pfval)
                        <?php $pfkey = str_replace(' ','_',strtolower($pfkey)); 
                          $servicepriceoption =json_decode($service['servicepriceoption'],true);
                          ?>
                        <option value='{{$pfkey}}' @if(@in_array($pfkey,$servicepriceoption)) selected @endif> {{$pfval}}</option>
                        @endforeach
                    </select>
                </div>
                <br>

                <div class="row hrsam tax-wrapper">
                    <div class="col-md-3">
                        <h2 class="additionheading">Tax</h2>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form samm">
                                <div class="form-control">
                                    <div class="btn-group" data-toggle="buttons">

                                        <label class="btn btn-primary percentageckeck  @if($service['salestax'] == 'salestax') active @endif">
                                            <input type="checkbox" value="salestax" onClick="" class="" name="salestax" @if($service['salestax']=='salestax' ) checked @endif autocomplete="off">
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                        <span class="tax-chk-label">
                                            Sales Tax
                                        </span>
                                        <a href="#" class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top" title="Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.">?</a>
                                        <!--<div class="tooltip"> ?-->
                                        <!--	<span class="tooltiptext">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</span>-->
                                        <!--</div>-->
                                        <!-- <div class="clearfix"></div> -->
                                        <div id="salestaxpercentage" @if($service['salestax']=='' ) style="display:none;position: absolute;right: 45%;" @endif>

                                            <input type="text" value="{{$service['salestaxpercentage']}}" name="salestaxpercentage" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="percentage"> %

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form samm">
                                <div class="form-control">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary percentageckeck @if($service['duestax'] == 'duestax') active @endif">
                                            <input type="checkbox" onClick="" value="duestax" class="" name="duestax" @if($service['duestax']=='duestax' ) checked @endif>
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                        <span class="tax-chk-label">
                                            Dues Tax
                                        </span>
                                        <a href="#" class="tooltip-custom sp2" data-toggle="tooltip" data-placement="top" title="Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.">?</a>
                                        <!--<div class="tooltip"> ?-->
                                        <!--    	<span class="tooltiptext">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</span>-->
                                        <!--    </div>-->
                                        <div id="duestaxpercentage" @if($service['duestax']=='' ) style="display:none;position: absolute;right: 45%;" @endif>

                                            <input type="text" value="{{$service['duestaxpercentage']}}" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="duestaxpercentage" class="percentage"> %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
                <div class="row hrsam expire-wrapper">
                    <div class="col-md-3">
                        <h2 class="additionheading">Expires</h2>
                    </div>
                    <div class="col-md-9">
                        <div id="setnumbermsg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Set Number</label>
                                <input type="text" class="form-control setnumber" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="expire_days" value="{{$service['expire_days']}}">
                            </div>
                            <div class="col-md-3">
                                <label>Duration</label>
                                <select name="expire_in_option" class="form-control">
                                    {{--<option @if($service['expire_in_option'] == 'Minute') selected @endif value="Minute">Minute</option>
                                  <option @if($service['expire_in_option'] == 'Hour') selected @endif value="Hour">Hour</option>--}}
                                    <option @if($service['expire_in_option']=='Day' ) selected @endif value="Day">Day</option>
                                    <option @if($service['expire_in_option']=='Weeks' ) selected @endif value="Weeks">Weeks</option>
                                    <option @if($service['expire_in_option']=='Months' ) selected @endif value="Months">Months(s)</option>
                                    <option @if($service['expire_in_option']=='Year' ) selected @endif value="Year">Year</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label>&nbsp;</label>
                                <span>after</span>
                            </div>
                            <div class="col-sm-6">
                                <label>&nbsp;</label>
                                <select name="after_drop" class="form-control" id="after_drop">
                                    <option @if($service['after_drop'] && ($service['after_drop']=='The sales dates' )) selected @endif value="The sales dates">The sales dates</option>
                                    <option @if($service['after_drop'] && ($service['after_drop']=='The date of client first visit' )) selected @endif value="The date of client first visit">The date of client's first visit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row hrsam session-wrpper">
                    <div class="col-md-3">
                        <h2 class="additionheading">Number of Sessions</h2>
                    </div> <!-- col-md-3 -->
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 qh-steps-form samm">
                                <div class="form-control">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary multises @if($service['sessions'] == 'single') active @endif">
                                            <input type="radio" value="single" class="chkdy" name="sessions" autocomplete="off" @if($service['sessions']=='single' ) checked @endif>
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                        Single Session
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 qh-steps-form samm">
                                <div class="form-control">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary multises @if($service['sessions'] == 'multiple') active @endif">
                                            <input type="radio" value="multiple" class="chkdy" @if($service['sessions']=='multiple' ) checked @endif name="sessions" autocomplete="off">
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                        Multiple Sessions
                                        <div id="multisession" style="text-align: initial; @if($service['sessions'] != 'multiple') display:none @endif">
                                            <input type="text" name="multiple_count" value="{{$service['multiple_count']}}" class="msesinput"> &nbsp; <span style="margin-top: 10px;margin-left: 5px;font-size: 14px;color: #505050;">Sessions</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 qh-steps-form samm">
                                <div class="form-control">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary multises @if($service['sessions'] == 'unlimited') active @endif">
                                            <input type="radio" value="99999" class="chkdy" name="sessions" autocomplete="off" @if($service['sessions']=='unlimited' ) checked @endif>
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                        Unlimited Sessions
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--col-md-9 -->
                </div> <!-- row end -->

                <div class="row hrsam">
                    <h3 class="setterms">Autopay Contract</h3>
                    <div class="col-md-3">
                        <h2 class="additionheading">Is this a recurring payment?</h2>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 qh-steps-form samm">
                                <div class="form-control">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary recurring_pay @if($service['recurring_pay'] == 1) active @endif">
                                            <input type="radio" value="1" class="chkdy" @if($service['recurring_pay']==1) checked @endif name="recurring_pay" autocomplete="off">
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                        Yes
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 qh-steps-form samm">
                                <div class="form-control">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary recurring_pay @if($service['recurring_pay'] == 0) active @endif">
                                            <input type="radio" value="0" class="chkdy" @if($service['recurring_pay']==0) checked @endif name="recurring_pay" autocomplete="off">
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                        No
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div @if($service['recurring_pay']==0) style="display:none" @endif id="recurring_pay">
                    <div class="row hrsam">
                        <div class="col-md-3">
                            <h2 class="additionheading" style="color: #000;">Is this an Intro offer? (limit of 1 per client)</h2>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 qh-steps-form samm">
                                    <div class="form-control">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary @if($service['introoffer'] == 0) active @endif">
                                                <input type="radio" value="0" class="chkdy" name="introoffer" autocomplete="off" @if($service['introoffer']==0) checked @endif>
                                                <span class="glyphicon glyphicon-ok"></span> </label>
                                            no
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 qh-steps-form samm">
                                    <div class="form-control">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary @if($service['introoffer'] == 1) active @endif">
                                                <input type="radio" value="1" class="chkdy" name="introoffer" autocomplete="off" @if($service['introoffer']==1) checked @endif>
                                                <span class="glyphicon glyphicon-ok"></span> </label>
                                            Yes, for new clinets only
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 qh-steps-form samm">
                                    <div class="form-control">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary @if($service['introoffer'] == 2) active @endif">
                                                <input type="radio" value="2" class="chkdy" name="introoffer" autocomplete="off" @if($service['introoffer']==2) checked @endif>
                                                <span class="glyphicon glyphicon-ok"></span> </label>
                                            Yes, for new and existing clinets
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row hrsam">
                        <div class="col-md-3">
                            <h2 class="additionheading" style="color: #000;">Run autopay</h2>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 qh-steps-form samm">
                                    <div class="form-control">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary @if($service['runautopay'] == 'on_a_set_schedule') active @endif">
                                                <input type="radio" value="on_a_set_schedule" class="chkdy" name="runautopay" autocomplete="off" @if($service['runautopay']=='on_a_set_schedule' ) checked @endif>
                                                <span class="glyphicon glyphicon-ok"></span> </label>
                                            On a set Schedule (recommended)
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 qh-steps-form samm">
                                    <div class="form-control">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary @if($service['runautopay'] == 'when_the_priceing') active @endif">
                                                <input type="radio" value="when_the_priceing" class="chkdy" name="runautopay" autocomplete="off" @if($service['runautopay']=='when_the_priceing' ) checked @endif>
                                                <span class="glyphicon glyphicon-ok"></span> </label>
                                            When the Priceing option run out
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- autopay-->
                    <div class="row hrsam">
                        <div class="col-md-3">
                            <h2 class="additionheading" style="color: #000;">how often will clients be charged?</h2>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 qh-steps-form samm">
                                    <div class="form-control">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary myautopay @if($service['often'] == '0') active @endif">
                                                <input type="radio" value="0" class="chkdy" name="often" @if($service['often']=='0' ) checked @endif autocomplete="off">
                                                <span class="glyphicon glyphicon-ok"></span> </label>
                                            Set of number of autopay
                                        </div>
                                    </div>
                                </div>
                                <div id="monthtomonth" @if($service['often'] !='0' ) style="display:none" @endif>
                                    <div class="oftenmonth-wrapper">
                                        <div class="col-md-3 often" style="width: auto;">
                                            <p>Every</p>
                                        </div>
                                        <div class="col-md-3 often">
                                            <select name="often_every_op1" class="form-control" id="select_box_number">
                                                <option @if($service['often_every_op1']==1) selected @endif value="1">1</option>
                                                <option @if($service['often_every_op1']==2) selected @endif value="2">2</option>
                                                <option @if($service['often_every_op1']==3) selected @endif value="3">3</option>
                                                <option @if($service['often_every_op1']==4) selected @endif value="4">4</option>
                                                <option @if($service['often_every_op1']==5) selected @endif value="5">5</option>
                                                <option @if($service['often_every_op1']==6) selected @endif value="6">6</option>
                                                <option @if($service['often_every_op1']==7) selected @endif value="7">7</option>
                                                <option @if($service['often_every_op1']==8) selected @endif value="8">8</option>
                                                <option @if($service['often_every_op1']==9) selected @endif value="9">9</option>
                                                <option @if($service['often_every_op1']==10) selected @endif value="10">10</option>
                                                <option @if($service['often_every_op1']==11) selected @endif value="11">11</option>
                                                <option @if($service['often_every_op1']==12) selected @endif value="12">12</option>
                                                <option @if($service['often_every_op1']==13) selected @endif value="13">13</option>
                                                <option @if($service['often_every_op1']==14) selected @endif value="14">14</option>
                                                <option @if($service['often_every_op1']==15) selected @endif value="15">15</option>
                                                <option @if($service['often_every_op1']==16) selected @endif value="16">16</option>
                                                <option @if($service['often_every_op1']==17) selected @endif value="17">17</option>
                                                <option @if($service['often_every_op1']==18) selected @endif value="18">18</option>
                                                <option @if($service['often_every_op1']==19) selected @endif value="19">19</option>
                                                <option @if($service['often_every_op1']==20) selected @endif value="20">20</option>
                                                <option @if($service['often_every_op1']==21) selected @endif value="21">21</option>
                                                <option @if($service['often_every_op1']==22) selected @endif value="22">22</option>
                                                <option @if($service['often_every_op1']==23) selected @endif value="23">23</option>
                                                <option @if($service['often_every_op1']==24) selected @endif value="24">24</option>
                                                <option @if($service['often_every_op1']==25) selected @endif value="25">25</option>
                                                <option @if($service['often_every_op1']==26) selected @endif value="26">26</option>
                                                <option @if($service['often_every_op1']==27) selected @endif value="27">27</option>
                                                <option @if($service['often_every_op1']==28) selected @endif value="28">28</option>
                                                <option @if($service['often_every_op1']==29) selected @endif value="29">29</option>
                                                <option @if($service['often_every_op1']==30) selected @endif value="30">30</option>
                                                <option @if($service['often_every_op1']==31) selected @endif value="31">31</option>
                                                <option @if($service['often_every_op1']==32) selected @endif value="32">32</option>
                                                <option @if($service['often_every_op1']==33) selected @endif value="33">33</option>
                                                <option @if($service['often_every_op1']==34) selected @endif value="34">34</option>
                                                <option @if($service['often_every_op1']==35) selected @endif value="35">35</option>
                                                <option @if($service['often_every_op1']==36) selected @endif value="36">36</option>

                                            </select>
                                        </div>
                                        <div class="col-md-3 often">
                                            <select name="often_every_op2" class="form-control" id="select_box_month">
                                                <option @if($service['often_every_op2']=='Week' ) selected @endif value="Week">Week</option>
                                                <option @if($service['often_every_op2']=='Months' ) selected @endif value="Months">Month(s)</option>

                                                <option @if($service['often_every_op2']=='Year' ) selected @endif value="Year">Year</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <br /> -->
                                <div class="col-md-12 row">
                                    <div id="myautopaynum" style="@if($service['often'] != '0') display:none; @endif width: auto; padding: 0;">
                                        <div class="col-md-4 often" style="width: auto; padding: 0;">
                                            <span>Number of autopay</span>
                                        </div>
                                        <div class="col-md-8 often">
                                            <input type="number" class="form-control" id="numberofpays" name="numberofpays" style="width: 80%;border:1px solid;" value="{{$service['numberofpays']}}">
                                            <span>Total duration of contract : <span id="number_span">0</span> <span id="month_span">Week</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 qh-steps-form samm">
                                    <div class="form-control">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary myautopay  @if($service['often'] == '1') active @endif">
                                                <input type="radio" value="1" class="chkdy" name="often" autocomplete="off" @if($service['often']=='1' ) checked @endif>
                                                <span class="glyphicon glyphicon-ok"></span> </label>
                                            Month to month
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- autopay end-->

                    <div class="row hrsam">
                        <div class="col-md-3">
                            <h2 class="additionheading" style="color: #000;">when will clients be charged?</h2>
                        </div>
                        <div class="col-md-6">
                            <?php
                    $op = array("on the sale date"=>"on the sale date",
"1st of the month"=>"1st of the month",
"15th of the month"=>"15th of the month",
"Last day of the month"=>"Last day of the month",
"1st of 15th of the month"=>"1st of 15th of the month",
"1st of 16th of the month"=>"1st of 16th of the month",
"15th of last day of the month"=>"15th of last day of the month",
"Specific date"=>"Specific date");
                    ?>
                            <select name="chargeclients" class="form-control">
                                @foreach ($op as $key=>$val)
                                <?php $key = str_replace(' ','_',strtolower($key)); 
                                
                                ?>
                                <option value="{{$key}}" @if($service['chargeclients']==$key) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div> <!-- hide and show-->
                <div class="row hrsam terms-wrap">
                    <h3 class="setterms">Set Your Terms</h3>
                    <p style="font-weight:600; padding-left: 17px;">Covid – 19 Protocols</p>
                    <p style="text-align: initial;padding-left: 17px;">Select the section you require your clients to agree to upon completing registration.</p>
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                            <div class="form-control">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary termcondfaq @if($service['termcondfaq'] == 1) active @endif">
                                        <input type="checkbox" value="1" class="chkdy" name="termcondfaq" @if($service['termcondfaq']==1) checked @endif autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span> </label>
                                    Terms, Conditions, FAQ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="termfaq" @if($service['termcondfaq'] !=1) style="display:none" @endif>
                        <textarea type="number" class="form-control" id="termcondfaqtext" name="termcondfaqtext"> {{$service['terms_conditions']}}</textarea>
                    </div>
                    <p id="termcondfaqtexterror" style="display:none;" class="error"></p>
                </div>
                <div class="row terms-wrap">
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                            <div class="form-control">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary contractterms @if($service['contractterms'] == 1) active @endif">
                                        <input type="checkbox" value="1" class="chkdy" name="contractterms" @if($service['contractterms']==1) checked @endif autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span> </label>
                                    Contract Terms
                                    <a href="#" class="tooltip-custom" data-toggle="tooltip" data-placement="top" title="Incase, no contract please enter NA">?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="contractterms" @if($service['contractterms'] !=1) style="display:none" @endif>
                        <textarea type="number" class="form-control" id="contracttermstext" name="contracttermstext"> {{$service['contracttermstext']}}</textarea>
                    </div>
                    <p id="contracttermstexterror" style="display:none;" class="error"></p>
                </div>
                <div class="row terms-wrap">
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                            <div class="form-control">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary liability @if($service['liability'] == 1) active @endif">
                                        <input type="checkbox" value="1" class="chkdy" name="liability" @if($service['liability']==1) checked @endif autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span> </label>
                                    Liability
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="liability" @if($service['liability'] !=1) style="display:none" @endif>
                        <textarea type="number" class="form-control" id="liabilitytext" name="liabilitytext"> {{$service['liabilitytext']}}</textarea>
                    </div>
                    <p id="liabilitytexterror" style="display:none;" class="error"></p>
                </div>

                <div class="row terms-wrap">
                    <div class="col-md-3">
                        <div class="qh-steps-form samm">
                            <div class="form-control">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary covid @if($service['covid'] == 1) active @endif">
                                        <input type="checkbox" value="1" class="chkdy" name="covid" @if($service['covid']==1) checked @endif autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span> </label>
                                    Covid – 19 Protocols
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="covid" @if($service['covid'] !=1) style="display:none" @endif>
                        <textarea type="number" class="form-control" id="covidtext" name="covidtext"> {{$service['covidtext']}}</textarea>
                    </div>
                    <p id="covidtexterror" style="display:none;" class="error"></p>
                </div>

                <div>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step active"></span>
                </div>
                <div class="modallink mt20">
                    <div class="signup-new-customer text-center">

                        <button type="button" class="stepbtn" href="#" onclick="$('#mayankstep1').hide();$('#mayankstep2').hide();$('#mayankstep3').hide();$('#mayankstepwhere').show();$('#service_new').text('Where and When')">PREVIOUS</button>
                        <button type="button" id="submit_service">SUBMIT</button>

                    </div>
                </div>

            </div>
            <br>
            <!--end mayankstep3-->



        </div>

        <!-- <div class="modallink mt20">
                        <div class="signup-new-customer text-center">
                            <button type="button" onclick="$('#step6').show();$('#addServiceModal').hide();">Previous Step</button>
                        </div>
                     </div> -->
    </div>



</div>
<script>
    function no_backspaces(event) {
        backspace = 8;
        if (event.keyCode == backspace) event.preventDefault();
    }

</script>
<script>
    $(document).on('click', '.mymodalclose', function() {
        $('#addServiceEditModal').hide()
        $('#addServiceEditModal').css('display', 'none')
        $('#step6').show()
    })
    $(".day-time-div-main").on('click', '.dys', function() {
        //console.log($(this).attr('class'))
        if ($(this).attr('class').includes("day_circle_fill")) {
            $(this).removeClass("day_circle_fill")
            if ($(this).attr('class').includes('Sunday')) {
                $(this).parent().parent().children().children(".sunday_start").hide()
                $(this).parent().parent().children().children(".sunday_start").children().children().children($("input[name='hours[sunday_start]']")).val('')
                $(this).parent().parent().children().children(".sunday_start").children().children().children($("input[name='hours[sunday_end]']")).val('')

            }
            if ($(this).attr('class').includes('Monday')) {
                $(this).parent().parent().children().children(".monday_start").hide()
                $(this).parent().parent().children().children(".monday_start").children().children().children($("input[name='hours[monday_start]']")).val('')
                $(this).parent().parent().children().children(".monday_start").children().children().children($("input[name='hours[monday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Tuesday')) {
                $(this).parent().parent().children().children(".tuesday_start").hide()
                $(this).parent().parent().children().children(".tuesday_start").children().children().children($("input[name='hours[tuesday_start]']")).val('')
                $(this).parent().parent().children().children(".tuesday_start").children().children().children($("input[name='hours[tuesday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Wednesday')) {
                $(this).parent().parent().children().children(".wednesday_start").hide()
                $(this).parent().parent().children().children(".wednesday_start").children().children().children($("input[name='hours[wednesday_start]']")).val('')
                $(this).parent().parent().children().children(".wednesday_start").children().children().children($("input[name='hours[wednesday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Thrusday')) {
                $(this).parent().parent().children().children(".thrusday_start").hide()
                $(this).parent().parent().children().children(".thrusday_start").children().children().children($("input[name='hours[thrusday_start]']")).val('')
                $(this).parent().parent().children().children(".thrusday_start").children().children().children($("input[name='hours[thrusday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Friday')) {
                $(this).parent().parent().children().children(".friday_start").hide()
                $(this).parent().parent().children().children(".friday_start").children().children().children($("input[name='hours[friday_start]']")).val('')
                $(this).parent().parent().children().children(".friday_start").children().children().children($("input[name='hours[friday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Saturday')) {
                $(this).parent().parent().children().children(".saturday_start").hide()
                $(this).parent().parent().children().children(".saturday_start").children().children().children($("input[name='hours[saturday_start]']")).val('')
                $(this).parent().parent().children().children(".saturday_start").children().children().children($("input[name='hours[saturday_end]']")).val('')
            }
        } else {
            $(this).addClass("day_circle_fill")
            if ($(this).attr('class').includes('Sunday'))
                $(this).parent().parent().children().children(".sunday_start").show()
            if ($(this).attr('class').includes('Monday'))
                $(this).parent().parent().children().children(".monday_start").show()
            if ($(this).attr('class').includes('Tuesday'))
                $(this).parent().parent().children().children(".tuesday_start").show()
            if ($(this).attr('class').includes('Wednesday'))
                $(this).parent().parent().children().children(".wednesday_start").show()
            if ($(this).attr('class').includes('Thrusday'))
                $(this).parent().parent().children().children(".thrusday_start").show()
            if ($(this).attr('class').includes('Friday'))
                $(this).parent().parent().children().children(".friday_start").show()
            if ($(this).attr('class').includes('Saturday'))
                $(this).parent().parent().children().children(".saturday_start").show()
        }
        // if($(this).attr('class').includes('Sunday'))
        //         $(this).parent().parent().children().children(".sunday_start").show()
        //     if($(this).attr('class').includes('Monday'))
        //         $(this).parent().parent().children().children(".monday_start").show()
        //     if($(this).attr('class').includes('Tuesday'))
        //         $(this).parent().parent().children().children(".tuesday_start").show()
        //     if($(this).attr('class').includes('Wednesday'))
        //         $(this).parent().parent().children().children(".wednesday_start").show()
        //     if($(this).attr('class').includes('Thrusday'))
        //         $(this).parent().parent().children().children(".thrusday_start").show()
        //     if($(this).attr('class').includes('Friday'))
        //         $(this).parent().parent().children().children(".friday_start").show()
        //     if($(this).attr('class').includes('Saturday'))
        //         $(this).parent().parent().children().children(".saturday_start").show()
    })


    var i = 0
    $(".add-another-time").click(function() {
        i = i + 1;
        console.log("iii " + i)
        var str = '<div class="day-time-div">' +
            '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>' +
            '<div class="row">' +
            '<div class="col-sm-1 day_circle Sunday dys">' +
            '<p>Su</p>' +
            '</div>' +
            '<div class="col-sm-1 day_circle Monday dys">' +
            '<p>Mo</p>' +
            '</div>' +
            '<div class="col-sm-1 day_circle Tuesday dys">' +
            '<p>Tu</p>' +
            '</div>' +
            '<div class="col-sm-1 day_circle Wednesday dys">' +
            '<p>We</p>' +
            '</div>' +
            '<div class="col-sm-1 day_circle Thrusday dys">' +
            '<p>Th</p>' +
            '</div>' +
            '<div class="col-sm-1 day_circle Friday dys">' +
            '<p>Fr</p>' +
            '</div>' +
            '<div class="col-sm-1 day_circle Saturday dys">' +
            '<p>Sa</p>' +
            '</div>' +
            '</div>' +
            '<div class="wrapperow">' +
            '<div class="form-control sunday_start" style="display:none;margin-top:10px;"><div class="row">' +
            '<label class="col-sm-12">Sunday Time</label><br/>' +
            '<div class="col-sm-5" >' +
            '<input type="text"  class="sunquicktimepicker' + i + '"  name="hours[sunday_start]"  autocomplete="off" style=" width:100%">' +
            '</div>' +
            ' <div class="col-sm-2"> &nbsp;-&nbsp;</div>' +
            '<div class="col-sm-5" >  ' +
            '<input type="text" class="timepicker" name="hours[sunday_end]"  autocomplete="off" style=" width:100%">' +
            '</div></div>' +
            '</div>' +

            '<div class="form-control monday_start" style="display:none;margin-top:10px;"><div class="row">' +
            '<label class="col-sm-12">Monday Time</label><br/>' +
            '<div class="col-sm-5" >' +
            '<input type="text"  class="monquicktimepicker' + i + '" name="hours[monday_start]" autocomplete="off" style=" width:100%">' +
            '</div>' +
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>' +
            '<div class="col-sm-5" >  ' +
            '<input type="text" class="timepicker" name="hours[monday_end]" autocomplete="off" style=" width:100%">' +
            '</div></div>' +
            '</div>' +

            '<div class="form-control tuesday_start" style="display:none;margin-top:10px;"><div class="row">' +
            '<label class="col-sm-12">Tuesday Time</label><br/>' +
            '<div class="col-sm-5" >' +
            '<input type="text"  class="tuesquicktimepicker' + i + '" name="hours[tuesday_start]"  autocomplete="off" style=" width:100%">' +
            '</div>' +
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>' +
            '<div class="col-sm-5" >' +
            '<input type="text" class="timepicker" name="hours[tuesday_end]"  autocomplete="off" style=" width:100%">' +
            '</div></div>' +
            '</div>' +

            '<div class="form-control wednesday_start" style="display:none;margin-top:10px;"><div class="row">' +
            '<label class="col-sm-12">Wednesday Time</label><br/>' +
            '<div class="col-sm-5" >' +
            '<input type="text"  class="wedquicktimepicker' + i + '" name="hours[wednesday_start]"  autocomplete="off" style=" width:100%">' +
            '</div>' +
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>' +
            '<div class="col-sm-5" > ' +
            '<input type="text" class="timepicker" name="hours[wednesday_end]" autocomplete="off" style=" width:100%">' +
            '</div></div>' +
            '</div>' +

            '<div class="form-control thrusday_start" style="display:none;margin-top:10px;"><div class="row">' +
            '<label class="col-sm-12">Thursday Time</label><br/>' +
            '<div class="col-sm-5" >' +
            '<input type="text"  class="thrusquicktimepicker' + i + '" name="hours[thrusday_start]" autocomplete="off" style=" width:100%">' +
            '</div>' +
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>' +
            '<div class="col-sm-5" >' +
            ' <input type="text" class="timepicker" name="hours[thrusday_end]"  autocomplete="off" style=" width:100%">' +
            '</div></div>' +
            '</div>' +

            '<div class="form-control friday_start" style="display:none;margin-top:10px;"><div class="row">' +
            '<label class="col-sm-12">Friday Time</label><br/>' +
            '<div class="col-sm-5" >' +
            '<input type="text"  class="friquicktimepicker' + i + '" name="hours[friday_start]"  autocomplete="off" style=" width:100%">' +
            '</div>' +
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>' +
            '<div class="col-sm-5" >' +
            '<input type="text" class="timepicker" name="hours[friday_end]" autocomplete="off" style=" width:100%">' +
            '</div></div>' +
            '</div>' +

            '<div class="form-control saturday_start" style="display:none;margin-top:10px;"><div class="row">' +
            '<label class="col-sm-12">Saturday Time</label><br/>' +
            '<div class="col-sm-5" >' +
            '<input type="text"  class="satquicktimepicker' + i + '" name="hours[saturday_start]" autocomplete="off" style=" width:100%">' +
            '</div>' +
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>' +
            '<div class="col-sm-5" >' +
            '<input type="text" class="timepicker" name="hours[saturday_end]" autocomplete="off" style=" width:100%">' +
            '</div></div>' +
            '</div>' +

            '</div>' +
            '</div>';

        $(".day-time-div-main").append(str);
        setTimeout(function() {
            myDayFunction();
            $('.day-time-div-main .timepicker').timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    if ($(this).parent().parent().children(':nth-child(3)').children().val() == '') {
                        $(this).val('')
                        showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select TO time without selecting from time.');
                    }
                }
            });
            $('.day-time-div-main .sunquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    console.log(sunday_start_arr)
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".sunquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
            $('.day-time-div-main .tuesquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[tuesday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".tuesquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
            $('.day-time-div-main .wedquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[wednesday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".wedquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
            $('.day-time-div-main .thrusquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[thrusday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".thrusquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
            $('.day-time-div-main .friquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[friday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".friquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
            $('.day-time-div-main .satquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[saturday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".satquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
            $('.day-time-div-main .monquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[monday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".monquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
        }, 100)
    })

    function hasDuplicates(array) {
        return (new Set(array)).size !== array.length;
    }
    var myday;
    $('#frm_class_meets').change(function() {
        console.log("run")
        console.log($("#frm_class_meets").val())
        console.log($("#startingpicker").val())
        $('.day-time-div').slice(1).remove()
        $('input[name="hours[sunday_start]"]').val('')
        $('input[name="hours[monday_start]"]').val('')
        $('input[name="hours[tuesday_start]"]').val('')
        $('input[name="hours[wednesday_start]"]').val('')
        $('input[name="hours[thrusday_start]"]').val('')
        $('input[name="hours[friday_start]"]').val('')
        $('input[name="hours[saturday_start]"]').val('')
        $('input[name="hours[sunday_end]"]').val('')
        $('input[name="hours[tuesday_end]"]').val('')
        $('input[name="hours[wednesday_end]"]').val('')
        $('input[name="hours[thrusday_end]"]').val('')
        $('input[name="hours[friday_end]"]').val('')
        $('input[name="hours[saturday_end]"]').val('')
        $('input[name="hours[monday_end]"]').val('')
        $(".dys").removeClass('day_circle_fill')
        $(".sunday_start").hide()
        $(".tuesday_start").hide()
        $(".wednesday_start").hide()
        $(".thrusday_start").hide()
        $(".friday_start").hide()
        $(".monday_start").hide()
        $(".saturday_start").hide()
        if ($("#frm_class_meets").val() == 'Weekly') {
            $(".schedule_until_box").show()
            if ($("#startingpicker").val() != '') {
                console.log("run11")
                $(".Sunday").removeClass("day_circle_fill")
                $(".Monday").removeClass("day_circle_fill")
                $(".Tuesday").removeClass("day_circle_fill")
                $(".Wednesday").removeClass("day_circle_fill")
                $(".Thrusday").removeClass("day_circle_fill")
                $(".Friday").removeClass("day_circle_fill")
                $(".Saturday").removeClass("day_circle_fill")
                $(".Monday").show()
                $(".Sunday").show()
                $(".Tuesday").show()
                $(".Wednesday").show()
                $(".Thrusday").show()
                $(".Friday").show()
                $(".Saturday").show()
                if ($("#startingpicker").val() != '') {
                    var day = moment($("#startingpicker").val(), 'MM-DD-YYYY').format('dddd')
                    if (day == 'Monday') {
                        $(".Monday").show()
                        $(".Monday").addClass('day_circle_fill')
                        $(".monday_start").show()
                    }
                    if (day == 'Tuesday') {
                        $(".Tuesday").show()
                        $(".Tuesday").addClass('day_circle_fill')
                        $(".tuesday_start").show()
                    }
                    if (day == 'Wednesday') {
                        $(".Wednesday").show()
                        $(".Wednesday").addClass('day_circle_fill')
                        $(".wednesday_start").show()
                    }
                    if (day == 'Thursday') {
                        $(".Thrusday").show()
                        $(".Thrusday").addClass('day_circle_fill')
                        $(".thrusday_start").show()
                    }
                    if (day == 'Friday') {
                        $(".Friday").show()
                        $(".Friday").addClass('day_circle_fill')
                        $(".friday_start").show()
                    }
                    if (day == 'Saturday') {
                        $(".Saturday").show()
                        $(".Saturday").addClass('day_circle_fill')
                        $(".saturday_start").show()
                    }
                    if (day == 'Sunday') {
                        $(".Sunday").show()
                        $(".Sunday").addClass('day_circle_fill')
                        $(".sunday_start").show()
                    }
                }
            }
        } else {
            $(".schedule_until_box").hide()
            if ($("#startingpicker").val() != '') {
                var day = moment($("#startingpicker").val(), 'MM-DD-YYYY').format('dddd')
                myday = moment($("#startingpicker").val(), 'MM-DD-YYYY').format('dddd')
                if (day == 'Monday') {
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").show()
                    $(".Monday").addClass('day_circle_fill');
                    $(".monday_start").show()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if (day == 'Tuesday') {
                    $(".sunday_start").hide()
                    $(".monday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").show()
                    $(".Tuesday").addClass('day_circle_fill');
                    $(".tuesday_start").show()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if (day == 'Wednesday') {
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".monday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").show()
                    $(".Wednesday").addClass('day_circle_fill');
                    $(".wednesday_start").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if (day == 'Thursday') {
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".monday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").show()
                    $(".Thrusday").addClass('day_circle_fill');
                    $(".thrusday_start").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if (day == 'Friday') {
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".monday_start").hide()
                    $(".saturday_start").hide()
                    $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").show()
                    $(".Friday").addClass('day_circle_fill');
                    $(".friday_start").hide()
                    $(".Saturday").hide()
                }
                if (day == 'Saturday') {
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".monday_start").hide()
                    $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").show()
                    $(".Saturday").addClass('day_circle_fill');
                    $(".saturday_start").hide()
                }
                if (day == 'Sunday') {

                    $(".monday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").show()
                    $(".Sunday").addClass('day_circle_fill');
                    $(".sunday_start").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
            }
        }
    })
    //$("#step4").show();
    $(document).on('click', '.rounded-corner', function() {
        console.log("runrun")
        console.log($(this).attr('date'))
        $('#mdp-demo').multiDatesPicker('toggleDate', moment($(this).attr('date'), 'MM/DD/YYYY').format('MM/DD/YYYY'));
        $(this).remove()
    })
    $('#mdp-demo').multiDatesPicker({
        separator: ", ",
        onSelect: function(dateText, inst) {
            $('.rounded-corner').each(function(i, obj) {
                console.log($(this))
                if ($(this).text() == dateText + ' x') {
                    console.log("if")
                    $(this).click()
                }
            });
            $('.manual-remove').append('<button type="button" date="' + dateText + '" class="rounded-corner">' + dateText + ' x</button>')
        }
    });

    //$("#company_intro").hide();
    //console.log("fdsfsdfds")
    var profile_pic_var = '';
    var add_service_var = '';
    var formdata = new FormData();
    $('.percentage').keyup(function() {
        var val = parseInt($(this).val());
        if ($.isNumeric(val)) {
            if (val == 0) {
                $(this).val('');
                $('#taxmsg').text('Please enter the value greater than 0').show();
                setTimeout(function() {
                    $('#taxmsg').hide()
                }, 3000);
            }
            if (val > 100) {
                $(this).val('');
                $('#taxmsg').text('Please enter the value less than 100').show();
                setTimeout(function() {
                    $('#taxmsg').hide()
                }, 3000);
                return false;
            }
        } else {
            $(this).val('');
            $('#taxmsg').text('Please enter only numbers').show();
            setTimeout(function() {
                $('#taxmsg').hide()
            }, 3000);
        }

    });
    $('.setnumber').keyup(function() {
        var val = parseInt($(this).val());
        if ($.isNumeric(val)) {
            if (val == 0) {
                $(this).val('');
                $('#setnumbermsg').text('Please enter the value greater than 0').show();
                setTimeout(function() {
                    $('#taxmsg').hide()
                }, 3000);
            }
            if (val > 100) {
                $(this).val('');
                $('#setnumbermsg').text('Please enter the value less than 100').show();
                setTimeout(function() {
                    $('#setnumbermsg').hide()
                }, 3000);
            }
        } else {
            $(this).val('');
            $('#setnumbermsg').text('Please enter only numbers').show();
            setTimeout(function() {
                $('#setnumbermsg').hide()
            }, 3000);
        }
    });
    $('#select_box_number').change(function() {
        //$("#number_span").text($('#select_box_number').val())
        if ($('#numberofpays').val() != '') {
            var k = $('#select_box_number').val()
            var l = $('#numberofpays').val()
            var j = k * l
            $("#number_span").text(j)
        }
        //console.log($('#select_box_number').val())
    })
    $('#select_box_month').change(function() {
        $("#month_span").text($('#select_box_month').val())
        //console.log($('#select_box_month').val())
    })
    $('#numberofpays').keyup(function() {
        if ($('#numberofpays').val() == '') {
            $("#number_span").text(0)
        } else {
            var k = $('#select_box_number').val()
            var l = $('#numberofpays').val()
            var j = k * l
            $("#number_span").text(j)
        }
    })
    $(".myautopay").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if (willing_to_travel_radio == 0) {
            $('#myautopaynum').show();
            $('#monthtomonth').show();
        } else {
            $('#monthtomonth').hide();
            $('#myautopaynum').hide();
        }
    });
    //});

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.blah').attr('src', e.target.result);
                var html = '<img src="' + e.target.result + '">';
                $('.uploadedpic').html(html);
                // $('.uploadedpic')
                //     .attr('src', e.target.result)
                //     .width(150)
                //     .height(200);
            };
            profile_pic_var = input.files[0];
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.blah').attr('src', e.target.result);
                var html = '<img src="' + e.target.result + '">';
                $('.uploadedpic1').html(html);
                // $('.uploadedpic')
                //     .attr('src', e.target.result)
                //     .width(150)
                //     .height(200);
            };
            add_service_var = input.files[0];
            reader.readAsDataURL(input.files[0]);
        }
    }
    var lat = ''
    var long = ''

    function initialize1(q) {
        console.log(q.value)
        console.log('callles')
        var input = q;
        console.log(input.value)
        var s = input.value

        // var streetaddress= input.substr(0, input.indexOf(',')); 
        // console.log(streetaddress)

        var autocomplete = new google.maps.places.Autocomplete(input);
        //  if(s != ''){
        //     var streetaddress= s.substr(0, s.indexOf(','));
        //     console.log(streetaddress)
        //     input.value = streetaddress
        // }
        $('.pac-container').css('z-index', '999999999');
        autocomplete.addListener('place_changed', function() {
            $('#b_EINnumber').focus();
            var place = autocomplete.getPlace();
            lat = place.geometry.location.lat();
            long = place.geometry.location.lng();
            for (var i = 0; i < place.address_components.length; i++) {
                for (var j = 0; j < place.address_components[i].types.length; j++) {
                    if (place.address_components[i].types[j] == "postal_code") {
                        $('#b_zipcode').val(place.address_components[i].long_name);
                    }
                    if (place.address_components[i].types[j] == "locality") {

                        if ($('#mybusinessid').val() == 0)
                            $('#b_city').val(place.address_components[i].long_name);
                        // document.getElementById('b_address').value = place.address_components[i].short_name;
                        //document.getElementById('b_city').value = place.address_components[i].short_name;
                    }
                    if (place.address_components[i].types[j] == "country") {
                        $('#b_country').val(place.address_components[i].short_name);
                    }
                    if (place.address_components[i].types[j] == "administrative_area_level_1") {
                        $('#b_state').val(place.address_components[i].long_name);
                    }
                }
            }
        });
    }

    //initialize();
    $('#milesnew').change(function() {
        //var miles = $('#milesnew option:selected').val();

        if ($('#milesnew option:selected').val() == 1 || $('#milesnew option:selected').val() == 3 || $('#milesnew option:selected').val() == 5) {
            var miles = 4;
            var zoom = 10;
        } else {
            var miles = $('#milesnew option:selected').val();
            var zoom = 8;
        }

        $('#map_canvas').empty();
        var map = new google.maps.Map(document.getElementById("map_canvas"), {
            zoom: zoom,
            center: new google.maps.LatLng(lat, long),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var circle = new google.maps.Circle({
            center: new google.maps.LatLng(lat, long),
            radius: miles * 1609.344,
            fillColor: "#ff69b4",
            fillOpacity: 0.5,
            strokeOpacity: 0.0,
            strokeWeight: 0,
            map: map
        });

    });

    function showEditDate() {
        $("#editDateDiv").toggle();
        $("#hoursshow").hide();
    }

    function hideEditDate() {
        $("#editDateDiv").hide();
    }

    function hidehoursshow() {
        $('#hoursshow').hide();
    }

    function hoursshow() {
        $('#hoursshow').toggle();
        $("#editDateDiv").hide();
    }
    //$(document).ready(function(){
    //     $('#passingyear').Zebra_DatePicker({
    //         default_position: 'below',
    //         container : $('#passingpicker-position')      
    // });
    $('#dp1').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        container: $('#dp1-position')
    });
    $('#dp2').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        container: $('#dp2-position')
    });
    $('#completionyear').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        container: $('#completionpicker-position')
    });
    $('#skillcompletionpicker').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        container: $('#skillcompletionpicker-position')
    });
    var yesterdar = moment().format('MM-DD-YYYY')
    $('#startingpicker').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        direction: [yesterdar, false],
        container: $('#startingpicker-position'),
        onSelect: function() {
            $('.day-time-div').slice(1).remove()
            $('input[name="hours[sunday_start]"]').val('')
            $('input[name="hours[monday_start]"]').val('')
            $('input[name="hours[tuesday_start]"]').val('')
            $('input[name="hours[wednesday_start]"]').val('')
            $('input[name="hours[thrusday_start]"]').val('')
            $('input[name="hours[friday_start]"]').val('')
            $('input[name="hours[saturday_start]"]').val('')
            $('input[name="hours[sunday_end]"]').val('')
            $('input[name="hours[tuesday_end]"]').val('')
            $('input[name="hours[wednesday_end]"]').val('')
            $('input[name="hours[thrusday_end]"]').val('')
            $('input[name="hours[friday_end]"]').val('')
            $('input[name="hours[saturday_end]"]').val('')
            $('input[name="hours[monday_end]"]').val('')
            $(".dys").removeClass('day_circle_fill')
            $(".sunday_start").hide()
            $(".tuesday_start").hide()
            $(".wednesday_start").hide()
            $(".thrusday_start").hide()
            $(".friday_start").hide()
            $(".monday_start").hide()
            $(".saturday_start").hide()
            var day = moment($(this).context.value, 'MM-DD-YYYY').format('dddd')
            var new_date = moment($('#startingpicker').val(), "MM-DD-YYYY").add($('#frm_schedule_until').val().split(' ')[0], 'M').format('YYYY-MM-DD')
            //console.log(new_date)
            $('#end_date').val(new_date)
            $('.mymy').show()
            if ($('#frm_class_meets').val() != 'Weekly') {
                if (day == 'Monday') {
                    $(".Monday").show()
                    $(".Monday").addClass('day_circle_fill')
                    $(".monday_start").show()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if (day == 'Tuesday') {
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").show()
                    $(".Tuesday").addClass('day_circle_fill')
                    $(".tuesday_start").show()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if (day == 'Wednesday') {
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").show()
                    $(".Wednesday").addClass('day_circle_fill')
                    $(".wednesday_start").show()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if (day == 'Thursday') {
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").show()
                    $(".Thrusday").addClass('day_circle_fill')
                    $(".thrusday_start").show()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if (day == 'Friday') {
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").show()
                    $(".Friday").addClass('day_circle_fill')
                    $(".friday_start").show()
                    $(".Saturday").hide()
                }
                if (day == 'Saturday') {
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").show()
                    $(".Saturday").addClass('day_circle_fill')
                    $(".saturday_start").show()
                }
                if (day == 'Sunday') {
                    $(".Monday").hide()
                    $(".Sunday").show()
                    $(".Sunday").addClass('day_circle_fill')
                    $(".sunday_start").show()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
            } else {
                $(".sunday_start").hide()
                $(".tuesday_start").hide()
                $(".wednesday_start").hide()
                $(".thrusday_start").hide()
                $(".friday_start").hide()
                $(".monday_start").hide()
                $(".saturday_start").hide()
                $(".Monday").show()
                $(".Sunday").show()
                $(".Tuesday").show()
                $(".Wednesday").show()
                $(".Thrusday").show()
                $(".Friday").show()
                $(".Saturday").show()
                if (day == 'Monday') {
                    $(".Monday").show()
                    $(".Monday").addClass('day_circle_fill')
                    $(".monday_start").show()
                }
                if (day == 'Tuesday') {
                    $(".Tuesday").show()
                    $(".Tuesday").addClass('day_circle_fill')
                    $(".tuesday_start").show()
                }
                if (day == 'Wednesday') {
                    $(".Wednesday").show()
                    $(".Wednesday").addClass('day_circle_fill')
                    $(".wednesday_start").show()
                }
                if (day == 'Thursday') {
                    $(".Thrusday").show()
                    $(".Thrusday").addClass('day_circle_fill')
                    $(".thrusday_start").show()
                }
                if (day == 'Friday') {
                    $(".Friday").show()
                    $(".Friday").addClass('day_circle_fill')
                    $(".friday_start").show()
                }
                if (day == 'Saturday') {
                    $(".Saturday").show()
                    $(".Saturday").addClass('day_circle_fill')
                    $(".saturday_start").show()
                }
                if (day == 'Sunday') {
                    $(".Sunday").show()
                    $(".Sunday").addClass('day_circle_fill')
                    $(".sunday_start").show()
                }
            }
        }
    });

    function myDayFunction() {
        console.log("run2")
        var day = moment($('#startingpicker').val(), 'MM-DD-YYYY').format('dddd')
        if ($('#frm_class_meets').val() != 'Weekly') {
            if (day == 'Monday') {
                $(".Monday").show()
                $(".Monday").addClass('day_circle_fill')
                $(".monday_start").show()
                $(".Sunday").hide()
                $(".Tuesday").hide()
                $(".Wednesday").hide()
                $(".Thrusday").hide()
                $(".Friday").hide()
                $(".Saturday").hide()
            }
            if (day == 'Tuesday') {
                $(".Monday").hide()
                $(".Sunday").hide()
                $(".Tuesday").show()
                $(".Tuesday").addClass('day_circle_fill')
                $(".tuesday_start").show()
                $(".Wednesday").hide()
                $(".Thrusday").hide()
                $(".Friday").hide()
                $(".Saturday").hide()
            }
            if (day == 'Wednesday') {
                $(".Monday").hide()
                $(".Sunday").hide()
                $(".Tuesday").hide()
                $(".Wednesday").show()
                $(".Wednesday").addClass('day_circle_fill')
                $(".wednesday_start").show()
                $(".Thrusday").hide()
                $(".Friday").hide()
                $(".Saturday").hide()
            }
            if (day == 'Thursday') {
                $(".Monday").hide()
                $(".Sunday").hide()
                $(".Tuesday").hide()
                $(".Wednesday").hide()
                $(".Thrusday").show()
                $(".Thrusday").addClass('day_circle_fill')
                $(".thrusday_start").show()
                $(".Friday").hide()
                $(".Saturday").hide()
            }
            if (day == 'Friday') {
                $(".Monday").hide()
                $(".Sunday").hide()
                $(".Tuesday").hide()
                $(".Wednesday").hide()
                $(".Thrusday").hide()
                $(".Friday").show()
                $(".Friday").addClass('day_circle_fill')
                $(".friday_start").show()
                $(".Saturday").hide()
            }
            if (day == 'Saturday') {
                $(".Monday").hide()
                $(".Sunday").hide()
                $(".Tuesday").hide()
                $(".Wednesday").hide()
                $(".Thrusday").hide()
                $(".Friday").hide()
                $(".Saturday").show()
                $(".Saturday").addClass('day_circle_fill')
                $(".saturday_start").show()
            }
            if (day == 'Sunday') {
                $(".Monday").hide()
                $(".Sunday").show()
                $(".Sunday").addClass('day_circle_fill')
                $(".sunday_start").show()
                $(".Tuesday").hide()
                $(".Wednesday").hide()
                $(".Thrusday").hide()
                $(".Friday").hide()
                $(".Saturday").hide()
            }
        } else {
            $(".Monday").show()
            $(".Sunday").show()
            $(".Tuesday").show()
            $(".Wednesday").show()
            $(".Thrusday").show()
            $(".Friday").show()
            $(".Saturday").show()
            if (day == 'Monday') {
                $(".Monday").show()
                $(".Monday").addClass('day_circle_fill')
                $(".monday_start").show()
            }
            if (day == 'Tuesday') {
                $(".Tuesday").show()
                $(".Tuesday").addClass('day_circle_fill')
                $(".tuesday_start").show()
            }
            if (day == 'Wednesday') {
                $(".Wednesday").show()
                $(".Wednesday").addClass('day_circle_fill')
                $(".wednesday_start").show()
            }
            if (day == 'Thursday') {
                $(".Thrusday").show()
                $(".Thrusday").addClass('day_circle_fill')
                $(".thrusday_start").show()
            }
            if (day == 'Friday') {
                $(".Friday").show()
                $(".Friday").addClass('day_circle_fill')
                $(".friday_start").show()
            }
            if (day == 'Saturday') {
                $(".Saturday").show()
                $(".Saturday").addClass('day_circle_fill')
                $(".saturday_start").show()
            }
            if (day == 'Sunday') {
                $(".Sunday").show()
                $(".Sunday").addClass('day_circle_fill')
                $(".sunday_start").show()
            }
        }
    }
    //}


    $("#b_EINnumber").keyup(function() {
        var $this = $(this);
        var input = $this.val();

        // 2
        input = input.replace(/[\W\s\._\-]+/g, '');

        // 3
        var split = 2;
        var chunk = [];

        for (var i = 0, len = input.length; i < len; i += split) {
            split = (i >= 2 && i <= 9) ? 7 : 2;
            chunk.push(input.substr(i, split));
        }

        // 4
        $this.val(function() {
            return chunk.join("-").toUpperCase();
        });
    })

    $('.day-time-div-main .timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        startTime: '00:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        change: function(time) {
            if ($(this).parent().parent().children(':nth-child(3)').children().val() == '') {
                $(this).val('')
                showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select TO time without selecting from time.');
            }
        }
    });

    $('.day-time-div-main .sunquicktimepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        startTime: '00:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        change: function(time) {
            var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            console.log(sunday_start_arr)
            setTimeout(function() {
                var g = hasDuplicates(sunday_start_arr)
                console.log(g)
                if (g == true) {
                    showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                    $(".sunquicktimepicker").val('')
                }
            }, 100)
        }
    });
    $('.day-time-div-main .tuesquicktimepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        startTime: '00:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        change: function(time) {
            var sunday_start_arr = $('input[name="hours[tuesday_start]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            setTimeout(function() {
                var g = hasDuplicates(sunday_start_arr)
                console.log(g)
                if (g == true) {
                    showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                    $(".tuesquicktimepicker").val('')
                }
            }, 100)
        }
    });
    $('.day-time-div-main .wedquicktimepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        startTime: '00:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        change: function(time) {
            var sunday_start_arr = $('input[name="hours[wednesday_start]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            setTimeout(function() {
                var g = hasDuplicates(sunday_start_arr)
                console.log(g)
                if (g == true) {
                    showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                    $(".wedquicktimepicker").val('')
                }
            }, 100)
        }
    });
    $('.day-time-div-main .thrusquicktimepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        startTime: '00:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        change: function(time) {
            var sunday_start_arr = $('input[name="hours[thrusday_start]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            setTimeout(function() {
                var g = hasDuplicates(sunday_start_arr)
                console.log(g)
                if (g == true) {
                    showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                    $(".thrusquicktimepicker").val('')
                }
            }, 100)
        }
    });
    $('.day-time-div-main .friquicktimepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        startTime: '00:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        change: function(time) {
            var sunday_start_arr = $('input[name="hours[friday_start]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            setTimeout(function() {
                var g = hasDuplicates(sunday_start_arr)
                console.log(g)
                if (g == true) {
                    showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                    $(".friquicktimepicker").val('')
                }
            }, 100)
        }
    });
    $('.day-time-div-main .satquicktimepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        startTime: '00:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        change: function(time) {
            var sunday_start_arr = $('input[name="hours[saturday_start]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            setTimeout(function() {
                var g = hasDuplicates(sunday_start_arr)
                console.log(g)
                if (g == true) {
                    showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                    $(".satquicktimepicker").val('')
                }
            }, 100)
        }
    });
    $('.day-time-div-main .monquicktimepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        startTime: '00:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        change: function(time) {
            var sunday_start_arr = $('input[name="hours[monday_start]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            setTimeout(function() {
                var g = hasDuplicates(sunday_start_arr)
                console.log(g)
                if (g == true) {
                    showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                    $(".monquicktimepicker").val('')
                }
            }, 100)
        }
    });


    $.fn.initialize = function() {
        //$.fn.initialize() {
        console.log(lat)
        console.log(long)
        console.log('called')
        var miles = 3;

        var map = new google.maps.Map(document.getElementById("map_canvas"), {
            zoom: 11,
            center: new google.maps.LatLng(lat, long),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var circle = new google.maps.Circle({
            center: new google.maps.LatLng(lat, long),
            radius: miles * 1609.344,
            fillColor: "#ff69b4",
            fillOpacity: 0.5,
            strokeOpacity: 0.0,
            strokeWeight: 0,
            map: map
        });
    }

    $("label.present_work_btn").click(function() {
        $("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));
        changeDateBasedonPresent();
    });

    function changeDateBasedonPresent() {
        if ($("#frm_ispresentcheck").attr("checked")) {
            $("#frm_ispresent").val("1");
            $("#dp2").val("Till Date");
            $("#dp2").attr("disabled", true);
        } else {
            $("#frm_ispresent").val("0");
            $("#dp2").val("");
            $("#dp2").attr("disabled", false);
        }
    }

    $(document).on('click', '.edlt', function() {
        // addServiceEditModal
        var serv = $(this).attr('service_id');
        editService(serv)
    })

    $(document).on('click', '#addServiceEditModal #submit_service', function() {
        setTimeout(function() {
            $('#addServiceEditModal').hide();
            getMyService();
            $('#step6').show();
        }, 1000)

    })

    function getMyService() { alert('dsfdsfdsf');
        $.ajax({
            url: '/getMyService?arr_service=' + JSON.stringify(arr_service),
            type: 'get',
            beforeSend: function() {
                $('.loader').show();
            },
            complete: function() {
                $('.loader').hide();
            },
            success: function(response) {
                var mystr = '';
                console.log(response)
                response.data.forEach(function(value, key) {
                    mystr = mystr + '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ' + response.data[key].id + '">' +
                        '<div class="services-list">' +
                        '<a href="#" class="decoration-none">' +
                        '<span class="brfcse"><i class="fa fa-briefcase"></i></span>' +
                        '</a>' +
                        '<div class="clearfix"></div>' +
                        '<h3>' +

                        '<span class="display_servicesport" style="padding-left: 30px;">' + response.data[key].sport_name + '</span>' +

                        '<a href="#" onclick="return false" service_id=' + response.data[key].id + ' class="delete_icon edlt"  disabled title="Edit this Service"><i class="fa fa-edit"></i></a>' +

                        '<a href="#" onclick="return false" service_id=' + response.data[key].id + ' class="delete_icon dlt"  disabled title="Delete this Service"><i class="fa fa-trash"></i></a>' +

                        '</h3>' +
                        '<div class="clearfix"></div>' +


                        '<p class="display_servicetitle"><strong>' + response.data[key].title + ' ' + response.data[key].price + '</strong></p>' +
                        '<div class="clearfix"></div>' +

                        '<p class="display_servicedesc">' + response.data[key].servicedesc + '</p>' +
                        ' </div>' +
                        '</div>';
                })
                $('#service_div').empty();
                $('#service_div').append(mystr);

            }
        });
    }

    function editService(rowcount) {
        $.ajax({
            url: '/get_serviceform2/' + rowcount,
            type: 'get',
            beforeSend: function() {
                $('.loader').show();
            },
            complete: function() {
                $('.loader').hide();
            },
            success: function(response) {
                $('#step6').hide()
                $('#addServiceEditModal').html(response);
                $('#addServiceEditModal').show();

                var frm_agerange = new SlimSelect({
                    select: '#frm_agerange'
                });
                var pp2 = new SlimSelect({
                    select: '#frm_servicefocuses'
                });
                var frm_servicelocation = new SlimSelect({
                    select: '#frm_servicelocation'
                });
                var teaching = new SlimSelect({
                    select: '#teaching'
                });
                var categ = new SlimSelect({
                    select: '#categ'
                });
                var activitytype = new SlimSelect({
                    select: '#activitytype'
                });
                var activitydesigned = new SlimSelect({
                    select: '#activitydesigned'
                });
                var frm_programfor = new SlimSelect({
                    select: '#frm_programfor'
                });
                var frm_experience_level = new SlimSelect({
                    select: '#frm_experience_level'
                });
                var frm_numberofpeople = new SlimSelect({
                    select: '#frm_numberofpeople'
                });
                //   var  activitytype= new SlimSelect({
                //     select: '#activitytype'
                //   });
                //   var  duration= new SlimSelect({
                //     select: '#duration'
                //   });
                var frm_specialdeals = new SlimSelect({
                    select: '#frm_specialdeals'
                });
                var frm_servicepriceoption = new SlimSelect({
                    select: '#frm_servicepriceoption'
                });
            }
        });


    }

    $("#add_service").click(function() {
        $('#addServiceModal').show();
        $('#step6').hide();
        //   $.ajax({
        //   url:'/get_serviceform',
        //   type:'get',
        //   beforeSend: function () {
        //      $('.loader').show();
        //   },
        //   complete: function () {
        //      $('.loader').hide();
        //   },
        //   success: function (response) { 

        //      $('#addService').show();
        //     //   $('#step6').hide();
        //     $('#addService').html(response);
        //     $('#addService').modal('show');

        //     $('#CreateCompanyModal').modal('hide');
        // setTimeout(function(){
        $('#stepbtn1').removeAttr('onclick')
        $('#stepbtn2').removeAttr('onclick')
        $('#stepbtnwhen').removeAttr('onclick')

        $('#stepbtn1').removeAttr('href')
        $('#stepbtn2').removeAttr('href')
        $('#stepbtnwhen').removeAttr('href')

        $('#submit_service').attr('type', 'button')
        var frm_agerange = new SlimSelect({
            select: '#frm_agerange'
        });
        var pp2 = new SlimSelect({
            select: '#frm_servicefocuses'
        });
        var frm_servicelocation = new SlimSelect({
            select: '#frm_servicelocation'
        });
        var teaching = new SlimSelect({
            select: '#teaching'
        });
        var categ = new SlimSelect({
            select: '#categ'
        });
        var activitytype = new SlimSelect({
            select: '#activitytype'
        });
        var activitydesigned = new SlimSelect({
            select: '#activitydesigned'
        });
        var frm_programfor = new SlimSelect({
            select: '#frm_programfor'
        });
        var frm_experience_level = new SlimSelect({
            select: '#frm_experience_level'
        });
        var frm_numberofpeople = new SlimSelect({
            select: '#frm_numberofpeople'
        });
        //   var  activitytype= new SlimSelect({
        //     select: '#activitytype'
        //   });
        //   var  duration= new SlimSelect({
        //     select: '#duration'
        //   });
        var frm_specialdeals = new SlimSelect({
            select: '#frm_specialdeals'
        });
        var frm_servicepriceoption = new SlimSelect({
            select: '#frm_servicepriceoption'
        });
        //       },20)
        //     }
        // });

        $('#service_new').text('Add Your Program');
        $('#mayankstep1').show();
        $('#mayankstep2').hide();
        $('#mayankstep3').hide();
    });


    $("#spcl_btn").click(function() {
        console.log("bivh")
        $err = 0
        if ($('input[name="availability[sunday_start]"]').val() == '') {
            if ($('input[name="availability[sunday_end]"]').val() != '') {
                $err = 1
            }
        } else {
            if ($('input[name="availability[sunday_end]"]').val() == '') {
                $err = 1
            }
        }
        if ($('input[name="availability[monday_start]"]').val() == '') {
            if ($('input[name="availability[monday_end]"]').val() != '') {
                $err = 1
            }
        } else {
            if ($('input[name="availability[monday_end]"]').val() == '') {
                $err = 1
            }
        }
        if ($('input[name="availability[tuesday_start]"]').val() == '') {
            if ($('input[name="availability[tuesday_end]"]').val() != '') {
                $err = 1
            }
        } else {
            if ($('input[name="availability[tuesday_end]"]').val() == '') {
                $err = 1
            }
        }
        if ($('input[name="availability[wednesday_start]"]').val() == '') {
            if ($('input[name="availability[wednesday_end]"]').val() != '') {
                $err = 1
            }
        } else {
            if ($('input[name="availability[wednesday_end]"]').val() == '') {
                $err = 1
            }
        }
        if ($('input[name="availability[thrusday_start]"]').val() == '') {
            if ($('input[name="availability[thrusday_end]"]').val() != '') {
                $err = 1
            }
        } else {
            if ($('input[name="availability[thrusday_end]"]').val() == '') {
                $err = 1
            }
        }
        if ($('input[name="availability[friday_start]"]').val() == '') {
            if ($('input[name="availability[friday_end]"]').val() != '') {
                $err = 1
            }
        } else {
            if ($('input[name="availability[friday_end]"]').val() == '') {
                $err = 1
            }
        }
        if ($('input[name="availability[saturday_start]"]').val() == '') {
            if ($('input[name="availability[saturday_end]"]').val() != '') {
                $err = 1
            }
        } else {
            if ($('input[name="availability[saturday_end]"]').val() == '') {
                $err = 1
            }
        }
        if ($err == 1) {
            showSystemMessages('#systemMessage1', 'danger', 'Enter both from and to date.');
        } else {
            $('#step5').hide();
            $('#step6').show();
            $.fn.initialize();
        }
        //$('#step5').hide();$('#step6').show();$.fn.initialize();
    })
    var x = new SlimSelect({
        select: '#train_to'
    });
    var p = new SlimSelect({
        select: '#testdemo'
    });

    var pp = new SlimSelect({
        select: '#where_choose'
    });
    var u = new SlimSelect({
        select: '#mcc'
    });
    //   var  categ= new SlimSelect({
    //     select: '#categ'
    //   });
    var personality = new SlimSelect({
        select: '#personality'
    });
    var personality_type = new SlimSelect({
        select: '#personality_type'
    });
    var skill = new SlimSelect({
        select: '#skill'
    });
    var fitness_goals_array = new SlimSelect({
        select: '#fitness_goals_array'
    });


    $("label.btn").click(function() {
        // find clicked button radio option name
        var radio_option = $(this).find('input[type=radio]');
        if ($(radio_option).is(':radio')) {
            var radio_option_name = $(radio_option).attr('name');
            // make all other options to null
            $('input[type=radio][name="' + radio_option_name + '"]').each(function() {
                $(this).closest('label.btn').removeClass('active');
            });

            $(this).addClass('active');
        }
    });

    $(".willing_to_travel").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]');
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');

        if (willing_to_travel_val == 'yes') {
            $('.travel_miles_div').show();
        } else {
            $('.travel_miles_div').hide();
        }

    });
    $(".medicaloption").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]');
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');
        if (willing_to_travel_val == 1) {
            $('.medicalyesno').show();
        } else {
            $('.medicalyesno').hide();
        }
    });
    $(".fitgolsop").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]');
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');
        if (willing_to_travel_val == 1) {
            $('.fitgolsyesno').show();
        } else {
            $('.fitgolsyesno').hide();
        }
    });
    $(".setupprice").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if (willing_to_travel_radio == 1) {
            $('#offpromo').show();
            $('#offprom_option').show();
        } else {
            $('#offpromo').hide();
            $('#offprom_option').hide();
        }
    });

    $(".multises").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if (willing_to_travel_radio == 'multiple') {
            $('#multisession').show();
        } else {
            $('#multisession').hide();
        }
    });
    $(".termcondfaq").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if (willing_to_travel_radio == 1) {
            $('#termfaq').toggle();
        }
    });
    $(".liability").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if (willing_to_travel_radio == 1) {
            $('#liability').toggle();
        }
    });
    $(".covid").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if (willing_to_travel_radio == 1) {
            $('#covid').toggle();
        }
    });
    $(".contractterms").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if (willing_to_travel_radio == 1) {
            $('#contractterms').toggle();
        }
    });


    $(".recurring_pay").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if (willing_to_travel_radio == 1) {
            $('#recurring_pay').show();
        } else {
            $('#recurring_pay').hide();
        }
    });

    $('.percentageckeck').click(function() {
        if ($(this).find('input[type=checkbox]').val() == 'salestax') {
            $('#salestaxpercentage').toggle();
            // $('.sp1').toggle();
        }
        if ($(this).find('input[type=checkbox]').val() == 'duestax') {
            $('#duestaxpercentage').toggle();
            // $('.sp2').toggle();
        }
    });



    function options_f(len, id) {
        $('#' + id).empty();
        for (i = 1; i <= len; i++) {
            $('#' + id).append('<option value="' + i + '">' + i + '</option>');
        }
    }

    $('#secdayweek').change(function() {
        var t = $('#secdayweek option:selected').val();
        var id = $('#secdayweek').attr('rel');
        console.log(t, "---", id)
        if (t == 'Days') {
            options_f(31, id);
        }
        if (t == 'Weeks') {
            options_f(52, id);
        }
        if (t == 'Months') {
            options_f(12, id);
        }
    });
    $('#firstdayweek').change(function() {
        var t = $('#firstdayweek option:selected').val();
        var id = $('#firstdayweek').attr('rel');
        console.log(t, "---", id)
        if (t == 'Days') {
            options_f(31, id);
        }
        if (t == 'Weeks') {
            options_f(52, id);
        }
        if (t == 'Months') {
            options_f(12, id);
        }
    });


    $('#step6_next').click(function() {
        if ($('input[name="willing_to_travel"]:checked').val() != null && $('input[name="willing_to_travel"]:checked').val() != 'undefined') {
            formdata.append('willing_to_travel', $('input[name="willing_to_travel"]:checked').val())
            formdata.append('travel_miles', $('#milesnew').val())
            formdata.append('mybusinessid', $('#mybusinessid').val())

            if (arr_service.length == 0) {
                showSystemMessages('#systemMessage1', 'danger', 'Please add service.');
            } else {

                $("#preview").show();
                $("#step6").hide()
            }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Please select willing to travel.');
        }
        //$('#step6').hide();$('#step6').show();
    })

    $(".s_form").click(function() {
        var posturl = '/profile/create/company';
        $('#step6_next').prop('disabled', true);
        formdata.append('arr_service', JSON.stringify(arr_service))
        formdata.append('_token', '{{csrf_token()}}')
        $.ajax({
            url: posturl,
            type: 'POST',
            dataType: 'json',
            enctype: 'multipart/form-data',
            data: formdata,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $("#_token").val()
            },
            beforeSend: function() {
                $('.s_form').prop('disabled', true);
                $('.loader').show();
                //showSystemMessages('#systemMessage', 'info', 'Please wait while we create a company with Fitnessity.');
            },
            complete: function() {
                $('.loader').hide();
                ccccccc
                $('.s_form').prop('disabled', false);
            },
            success: function(response) {
                $('.loader').hide();
                showSystemMessages('#systemMessage', response.type, response.msg);
                if (response.type === 'success') {
                    // window.location.href = response.redirecturl;
                    window.location.href = "{{ '/profile/viewProfile' }}";
                }
            }
        });
    })

    var formdata2 = new FormData();

    $('#stepbtn1').click(function() {
        formdata2.append('frm_profile_pic', add_service_var)
        if ($('#frm_servicesport').val() != '') {
            formdata2.append('frm_servicesport', $('#frm_servicesport').val())
            if ($('#frm_servicetitle').val() != '') {
                formdata2.append('frm_servicetitle', $('#frm_servicetitle').val())
                if ($('#frm_servicetimeslotfrom').val() != '') {
                    formdata2.append('frm_servicetimeslotfrom', $('input[name="frm_servicetimeslotfrom"]').val())
                    if ($('#frm_servicetimeslotto').val() != '') {
                        formdata2.append('frm_servicetimeslotto', $('input[name="frm_servicetimeslotto"]').val())
                        if ($('#frm_serviceprice').val() != '' && $('#frm_serviceprice').val() != '$') {
                            formdata2.append('frm_serviceprice', $('#frm_serviceprice').val())
                            if ($('#frm_servicedesc').val() != '') {
                                formdata2.append('frm_servicedesc', $('#frm_servicedesc').val())
                                $('#service_new').text('Tell us more about your services');
                                $('#mayankstep1').hide();
                                $('#mayankstep2').show();
                                $('#mayankstep3').hide();
                            } else {
                                showSystemMessages('#systemMessage1', 'danger', 'Program description is required.');
                            }
                        } else {
                            showSystemMessages('#systemMessage1', 'danger', 'Service price from is required.');
                        }
                    } else {
                        showSystemMessages('#systemMessage1', 'danger', 'Select slot to from is required.');
                    }
                } else {
                    showSystemMessages('#systemMessage1', 'danger', 'Select slot time from is required.');
                }
            } else {
                showSystemMessages('#systemMessage1', 'danger', 'Service title is required.');
            }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Select sport/activity.');
        }
    })

    $('#stepbtnwhen').click(function() {
        var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function() {
            return this.value; // $(this).val()
        }).get();
        var sunday_end_arr = $('input[name="hours[sunday_end]"]').map(function() {
            return this.value; // $(this).val()
        }).get();
        var monday_start_arr = $('input[name="hours[monday_start]"]').map(function() {
            return this.value; // $(this).val()
        }).get();
        var monday_end_arr = $('input[name="hours[monday_end]"]').map(function() {
            return this.value; // $(this).val()
        }).get();

        var tuesday_start_arr = $('input[name="hours[tuesday_start]"]').map(function() {
            return this.value; // $(this).val()
        }).get();
        var tuesday_end_arr = $('input[name="hours[tuesday_end]"]').map(function() {
            return this.value; // $(this).val()
        }).get();

        var wednesday_start_arr = $('input[name="hours[wednesday_start]"]').map(function() {
            return this.value; // $(this).val()
        }).get();
        var wednesday_end_arr = $('input[name="hours[wednesday_end]"]').map(function() {
            return this.value; // $(this).val()
        }).get();

        var thrusday_start_arr = $('input[name="hours[thrusday_start]"]').map(function() {
            return this.value; // $(this).val()
        }).get();
        var thrusday_end_arr = $('input[name="hours[thrusday_end]"]').map(function() {
            return this.value; // $(this).val()
        }).get();

        var friday_start_arr = $('input[name="hours[friday_start]"]').map(function() {
            return this.value; // $(this).val()
        }).get();
        var friday_end_arr = $('input[name="hours[friday_end]"]').map(function() {
            return this.value; // $(this).val()
        }).get();

        var saturday_start_arr = $('input[name="hours[saturday_start]"]').map(function() {
            return this.value; // $(this).val()
        }).get();
        var saturday_end_arr = $('input[name="hours[saturday_end]"]').map(function() {
            return this.value; // $(this).val()
        }).get();
        setTimeout(function() {
            var new_arr = [];
            for (var i = 0; i < sunday_start_arr.length; i++) {
                var tst = (thrusday_start_arr[i] == undefined || thrusday_start_arr[i] == 'undefined') ? "" : thrusday_start_arr[i];
                var tend = (thrusday_end_arr[i] == undefined || thrusday_end_arr[i] == 'undefined') ? "" : thrusday_end_arr[i];
                new_arr.push({
                    "sunday_start": sunday_start_arr[i],
                    "sunday_end": sunday_end_arr[i],
                    "monday_start": monday_start_arr[i],
                    "monday_end": monday_end_arr[i],
                    "tuesday_start": tuesday_start_arr[i],
                    "tuesday_end": tuesday_end_arr[i],
                    "wednesday_start": wednesday_start_arr[i],
                    "wednesday_end": wednesday_end_arr[i],
                    "thrusday_start": tst,
                    "thrusday_end": tend,
                    "friday_start": friday_start_arr[i],
                    "friday_end": friday_end_arr[i],
                    "saturday_start": saturday_start_arr[i],
                    "saturday_end": saturday_end_arr[i]
                })
                if (i + 1 == sunday_start_arr.length) {
                    formdata2.append("serv_time_slot", JSON.stringify(new_arr))
                }
            }
            console.log(new_arr)
            //formdata.append("serv_time_slot")
        }, 100)
        formdata2.append('class_meets', $('#frm_class_meets').val())
        formdata2.append('starting_date', $('#startingpicker').val())
        formdata2.append('end_date', $('#end_date').val())
        formdata2.append('schedule_until', $('#frm_schedule_until').val())
        if ($('#startingpicker').val() == '') {
            showSystemMessages('#systemMessage1', 'danger', 'Select Date.');
        } else {
            if (sunday_start_arr[0] == '' &&
                monday_start_arr[0] == '' &&
                tuesday_start_arr[0] == '' &&
                wednesday_start_arr[0] == '' &&
                thrusday_start_arr[0] == '' &&
                friday_start_arr[0] == '' &&
                saturday_start_arr[0] == '') {
                showSystemMessages('#systemMessage1', 'danger', 'Select Time.');
            } else {
                $('#service_new').text('Setup your payments');
                $('#mayankstep1').hide();
                $('#mayankstep3').show();
                $('#mayankstep2').hide();
                $('#mayankstepwhere').hide();
            }
        }

        //      $('#service_new').text('Setup your payments');
        // $('#mayankstep1').hide();$('#mayankstep3').show();$('#mayankstep2').hide();$('#mayankstepwhere').hide();
    })

    function removeServiceForm() {
        $('#frm_servicesport').val('')
        $('#frm_servicetitle').val('')
        $('#frm_serviceprice').val('')
        $('#frm_servicedesc').val('')
        $('#startingpicker').val('')
        $('#categ').val([])
        $('#activitydesigned').val([])
        $('#activitytype').val([])
        $('#frm_agerange').val([])
        $('#frm_programfor').val([])
        $('#frm_numberofpeople').val([])
        $('#frm_experience_level').val([])
        $('#teaching').val([])
        $('#frm_servicelocation').val([])
        $('#frm_servicefocuses').val([])
        $('#frm_class_meets').val('Weekly')
        $('#frm_schedule_until').val('1 Month')
        $('.schedule_until_box').show()
        $('#startingpicker').val('')
        $('#mayankstep2 .ss-value-delete').click();
        $('#frm_servicepriceoption').val([])
        $('#mayankstep3 .ss-value-delete').click();
        $('#termcondfaqtext').val('')
        $('#contracttermstext').val('')
        $('#liabilitytext').val('')
        $('#covidtext').val('')
        $(".Sunday").removeClass("day_circle_fill")
        $(".Monday").removeClass("day_circle_fill")
        $(".Tuesday").removeClass("day_circle_fill")
        $(".Wednesday").removeClass("day_circle_fill")
        $(".Thrusday").removeClass("day_circle_fill")
        $(".Friday").removeClass("day_circle_fill")
        $(".Saturday").removeClass("day_circle_fill")
        $(".Monday").show()
        $(".Sunday").show()
        $(".Tuesday").show()
        $(".Wednesday").show()
        $(".Thrusday").show()
        $(".Friday").show()
        $(".Saturday").show()
        $('input[name="hours[sunday_start]"]').val('')
        $('input[name="hours[monday_start]"]').val('')
        $('input[name="hours[tuesday_start]"]').val('')
        $('input[name="hours[wednesday_start]"]').val('')
        $('input[name="hours[thrusday_start]"]').val('')
        $('input[name="hours[friday_start]"]').val('')
        $('input[name="hours[saturday_start]"]').val('')
        $('input[name="hours[sunday_end]"]').val('')
        $('input[name="hours[monday_end]"]').val('')
        $('input[name="hours[tuesday_end]"]').val('')
        $('input[name="hours[wednesday_end]"]').val('')
        $('input[name="hours[thrusday_end]"]').val('')
        $('input[name="hours[friday_end]"]').val('')
        $('input[name="hours[saturday_end]"]').val('');
        $('#frm_specialdeals').val([])
        $('#frm_servicepriceoption').val([])
        $('.percentageckeck').removeClass('active')
        $('.multises').removeClass('active')
        $('#salestaxpercentage').hide()
        $('#duestaxpercentage').hide()
        $('input[name="salestaxpercentage"]').val('')
        $('input[name="duestaxpercentage"]').val('')
        $('input[name="expire_days"]').val('')
        $('select[name="expire_in_option"]').val('Day')
        $('select[name="after_drop"]').val('The sales dates')
        $('#multisession').hide()
        $("input[name='multiple_count']").val('')
        $('.termcondfaq').removeClass('active')
        $('#termfaq').hide();
        $('#termcondfaqtext').val('')
        $('.contractterms').removeClass('active')
        $('#contractterms').hide();
        $('#contracttermstext').val('')
        $('.liability').removeClass('active')
        $('.recurring_pay').removeClass('active')
        $('#liability').hide();
        $('#liabilitytext').val('')
        $('#covidtext').val('')
        $('#recurring_pay').hide()
        $('#frm_profile_pic').val(null);
        $('.uploadedpic1').html('<i class="fa fa-user" style="line-height: 56px;"></i>');
    }

    $('#stepbtn2').click(function() {
        console.log("edsfsdf")

        //if($('input[name="hours"]').val() != '' ){
        //formdata.append('hours',JSON.stringify($('input[name="hours"]').val()))
        if ($('#categ').val() != '' && $('#categ').val() != null) {
            formdata2.append('frm_servicetype', JSON.stringify($('#categ').val()))
            if ($('#activitydesigned').val() != '' && $('#activitydesigned').val() != null) {
                formdata2.append('activitydesignsfor', JSON.stringify($('#activitydesigned').val()))
                if ($('#activitytype').val() != '' && $('#activitytype').val() != null) {
                    formdata2.append('activitytype', JSON.stringify($('#activitytype').val()))
                    if ($('#frm_agerange').val() != '' && $('#frm_agerange').val() != null) {
                        formdata2.append('frm_agerange', JSON.stringify($('#frm_agerange').val()))
                        if ($('#frm_programfor').val() != '' && $('#frm_programfor').val() != null) {
                            formdata2.append('frm_programfor', JSON.stringify($('#frm_programfor').val()))
                            if ($('#frm_numberofpeople').val() != '' && $('#frm_numberofpeople').val() != null) {
                                formdata2.append('frm_numberofpeople', JSON.stringify($('#frm_numberofpeople').val()))
                                if ($('#frm_experience_level').val() != '' && $('#frm_experience_level').val() != null) {
                                    formdata2.append('frm_experience_level', JSON.stringify($('#frm_experience_level').val()))
                                    if ($('#teaching').val() != '' && $('#teaching').val() != null) {
                                        formdata2.append('frm_teachingstyle', JSON.stringify($('#teaching').val()))
                                        if ($('#frm_servicelocation').val() != '' && $('#frm_servicelocation').val() != null) {
                                            formdata2.append('frm_servicelocation', JSON.stringify($('#frm_servicelocation').val()))
                                            if ($('#frm_servicefocuses').val() != '' && $('#frm_servicefocuses').val() != null) {
                                                formdata2.append('frm_servicefocuses', JSON.stringify($('#frm_servicefocuses').val()))
                                                //$('#service_new').text('Setup your payments');
                                                $('#service_new').text('Where and When');
                                                // $('#mayankstep1').hide();$('#mayankstep3').show();$('#mayankstep2').hide();
                                                $('#mayankstep1').hide();
                                                $('#mayankstepwhere').show();
                                                $('#mayankstep3').hide();
                                                $('#mayankstep2').hide();
                                            } else {
                                                showSystemMessages('#systemMessage1', 'danger', 'Select activity experience.');
                                            }
                                        } else {
                                            showSystemMessages('#systemMessage1', 'danger', 'Select activity location.');
                                        }
                                    } else {
                                        showSystemMessages('#systemMessage1', 'danger', 'Select teaching style.');
                                    }

                                } else {
                                    showSystemMessages('#systemMessage1', 'danger', 'Select program experience level.');
                                }
                            } else {
                                showSystemMessages('#systemMessage1', 'danger', 'Select participant number.');
                            }
                        } else {
                            showSystemMessages('#systemMessage1', 'danger', 'Select activity for.');
                        }
                    } else {
                        showSystemMessages('#systemMessage1', 'danger', 'Select age range.');
                    }
                } else {
                    showSystemMessages('#systemMessage1', 'danger', 'Select activity type.');
                }
            } else {
                showSystemMessages('#systemMessage1', 'danger', 'Select designed for.');
            }
        } else {
            console.log("else")
            showSystemMessages('#systemMessage1', 'danger', 'Select provider type.');
        }
        //  }
        //  else{
        //      showSystemMessages('#systemMessage1', 'danger', 'Select hours.');
        //  }
    })
    var arr_service = [];

    $('#submit_service').click(function() {
        console.log(formdata2.serv_time_slot)
        //showSystemMessages('#systemMessage1', 'success', 'Service added successfully.');
        //$('.display_servicesport').text($("#frm_servicesport option:selected").html())
        // $('.display_servicetitle').text($("#frm_servicetitle").val()+' '+$("#frm_serviceprice").val())
        // $('.display_servicedesc').text($("#frm_servicedesc").val())

        //  $("#service_div").show();

        if ($('#frm_specialdeals').val() != null)
            formdata2.append('frm_specialdeals', JSON.stringify($('#frm_specialdeals').val()))
        if ($('#frm_servicepriceoption').val() != null)
            formdata2.append('frm_servicepriceoption', JSON.stringify($('#frm_servicepriceoption').val()))

        //  formdata.append('frm_serviceduration',$('#frm_servicetitle').val())

        formdata2.append('often_every_op1', $('#select_box_number').val())
        formdata2.append('often_every_op2', $('#select_box_month').val())
        formdata2.append('numberofpays', $('#numberofpays').val())

        formdata2.append('setupprice', $('input[name="setupprice"]:checked').val())
        formdata2.append('chargeclients', $('select[name="chargeclients"]').val())
        //formdata.append('offerpro_states',$('#frm_servicetitle').val())


        // formdata.append('serv_time_slot',$('#frm_servicetitle').val())
        formdata2.append('hours', JSON.stringify($('input[name="hours"]').val()))

        formdata2.append('salestax', $('input[name="salestax"]:checked').val())
        formdata2.append('salestaxpercentage', $('input[name="salestaxpercentage"]').val())
        formdata2.append('duestax', $('input[name="duestax"]:checked').val())
        formdata2.append('duestaxpercentage', $('input[name="duestaxpercentage"]').val())

        formdata2.append('expire_days', $('input[name="expire_days"]').val())
        formdata2.append('expire_in_option1', $('select[name="expire_in_option"]').val())
        //formdata.append('expire_in_option2',$('input[name="after_drop"]').val())
        formdata2.append('after_drop', $('select[name="after_drop"]').val())

        formdata2.append('sessions', $('input[name="sessions"]:checked').val())
        formdata2.append('multiple_count', $('input[name="multiple_count"]').val())

        if ($('input[name="recurring_pay"]:checked').val() != 'undefined')
            formdata2.append('recurring_pay', $('input[name="recurring_pay"]:checked').val())
        else
            formdata2.append('recurring_pay', 0)
        if ($('input[name="introoffer"]:checked').val() != 'undefined')
            formdata2.append('introoffer', $('input[name="introoffer"]:checked').val())
        else
            formdata2.append('introoffer', 0)
        if ($('input[name="runautopay"]:checked').val() != 'undefined')
            formdata2.append('runautopay', $('input[name="runautopay"]:checked').val())
        else
            formdata2.append('runautopay', 0)


        formdata2.append('often', $('input[name="often"]:checked').val())

        formdata2.append('termcondfaq', $('input[name="termcondfaq"]:checked').val())
        formdata2.append('termcondfaqtext', $('#termcondfaqtext').val())
        formdata2.append('contractterms', $('input[name="contractterms"]:checked').val())
        formdata2.append('contracttermstext', $('#contracttermstext').val())
        formdata2.append('liability', $('input[name="liability"]:checked').val())
        formdata2.append('liabilitytext', $('#liabilitytext').val())
        formdata2.append('covidtext', $('#covidtext').val())
        console.log(typeof($("#termcondfaqtext").val()))
        console.log($("#termcondfaqtext").val())
        if ($("#termcondfaqtext").val() != '' && $("#termcondfaqtext").val() != ' ' && $("#termcondfaqtext").val() != undefined) {
            $("#termcondfaqtexterror").text('')
            if ($("#contracttermstext").val() != '' && $("#contracttermstext").val() != ' ' && $("#contracttermstext").val() != undefined) {
                $("#contracttermstexterror").text('')
                if ($("#liabilitytext").val() != '' && $("#liabilitytext").val() != ' ' && $("#liabilitytext").val() != undefined) {
                    $("#liabilitytexterror").text('')

                    var posturl = '/profile/create/newService';
                    $('#submit_service').prop('disabled', true);
                    formdata2.append('_token', '{{csrf_token()}}')
                    $.ajax({
                        url: posturl,
                        type: 'POST',
                        dataType: 'json',
                        enctype: 'multipart/form-data',
                        data: formdata2,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $("#_token").val()
                        },
                        beforeSend: function() {
                            $('#submit_service').prop('disabled', true);
                            $('.loader').show();
                            //showSystemMessages('#systemMessage', 'info', 'Please wait while we create a company with Fitnessity.');
                        },
                        complete: function() {
                            $('.loader').hide();
                            $('#submit_service').prop('disabled', false);
                        },
                        success: function(response) {
                            $('.loader').hide();
                            var j = $("#frm_servicesport option:selected").html()
                            console.log(j)
                            console.log(response.message)
                            removeServiceForm()
                            showSystemMessages('#systemMessage', 'Service added successfully.');
                            $('#addServiceModal').hide();
                            $('#step6').show();
                            $('#step5').hide();;
                            $('#step4').hide();


                            var mystr = '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ' + response.message.id + '">' +
                                '<div class="services-list">' +
                                '<a href="#" class="decoration-none">' +
                                '<span class="brfcse"><i class="fa fa-briefcase"></i></span>' +
                                '</a>' +
                                '<div class="clearfix"></div>' +
                                '<h3>' +

                                '<span class="display_servicesport" style="padding-left: 30px;">' + j + '</span>' +

                                '<a href="#" onclick="return false" service_id=' + response.message.id + ' class="delete_icon edlt"  disabled title="Edit this Service"><i class="fa fa-edit"></i></a>' +

                                '<a href="#" onclick="return false" service_id=' + response.message.id + ' class="delete_icon dlt"  disabled title="Delete this Service"><i class="fa fa-trash"></i></a>' +

                                '</h3>' +
                                '<div class="clearfix"></div>' +


                                '<p class="display_servicetitle"><strong>' + response.message.title + ' ' + response.message.price + '</strong></p>' +
                                '<div class="clearfix"></div>' +

                                '<p class="display_servicedesc">' + response.message.servicedesc + '</p>' +
                                ' </div>' +
                                '</div>';
                            $('#service_div').append(mystr);
                            arr_service.push(response.message.id)

                        }
                    });

                    //showSystemMessages('#systemMessage1', 'success', 'Service added successfully.');
                    //$('#addServiceModal').hide();
                    //$('#step6').show();$('#step5').hide();;$('#step4').hide();
                } else {
                    showSystemMessages('#systemMessage1', 'danger', 'Liability text is required.');
                    $("#liabilitytexterror").text('Liability text is required')
                }
            } else {
                showSystemMessages('#systemMessage1', 'danger', 'Contract terms is required.');
                $("#contracttermstexterror").text('Contract Terms is required')
            }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Terms & condition is required.');
            $("#termcondfaqtexterror").text('Terms & Condition is required')
        }
    })

    $("#frm_schedule_until").change(function() {
        if ($('#startingpicker').val() != '') {
            var new_date = moment($('#startingpicker').val(), "MM-DD-YYYY").add($('#frm_schedule_until').val().split(' ')[0], 'M').format('YYYY-MM-DD')
            //console.log(new_date)
            $('#end_date').val(new_date)
        }
    })

    $(document).on('click', '.dlt', function() {
        var servi_id = $(this).attr('service_id');
        var posturl = '/profile/delete-service?service_id=' + servi_id;
        $.ajax({
            url: posturl,
            type: 'GET',
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $("#_token").val()
            },
            beforeSend: function() {
                //  $('#submit_service').prop('disabled', true);
                $('.loader').show();
                //showSystemMessages('#systemMessage', 'info', 'Please wait while we create a company with Fitnessity.');
            },
            complete: function() {
                $('.loader').hide();

                //$('#submit_service').prop('disabled', false);
            },
            success: function(response) {
                $('.' + servi_id).remove()
                showSystemMessages('#systemMessage', 'success', 'Service deleted successfully.');
                var index1 = arr_service.indexOf(servi_id)
                arr_service.splice(index1, 1)
            }
        })
    })

    $('#spcl_btn').click(function() {
        $(".error").empty();
        //  if($('input[name="hours_opt"]:checked').val() != ''){
        formdata.append('hours_opt', $('input[name="hours_opt"]:checked').val())
        var obj = {
            "sunday_start": $('input[name="availability[sunday_start]"]').val(),
            "sunday_end": $('input[name="availability[sunday_end]"]').val(),
            "monday_start": $('input[name="availability[monday_start]"]').val(),
            "monday_end": $('input[name="availability[monday_end]"]').val(),
            "tuesday_start": $('input[name="availability[tuesday_start]"]').val(),
            "tuesday_end": $('input[name="availability[tuesday_end]"]').val(),
            "wednesday_start": $('input[name="availability[wednesday_start]"]').val(),
            "wednesday_end": $('input[name="availability[wednesday_end]"]').val(),
            "thrusday_start": $('input[name="availability[thrusday_start]"]').val(),
            "thrusday_end": $('input[name="availability[thrusday_end]"]').val(),
            "friday_start": $('input[name="availability[friday_start]"]').val(),
            "friday_end": $('input[name="availability[friday_end]"]').val(),
            "saturday_start": $('input[name="availability[saturday_start]"]').val(),
            "saturday_end": $('input[name="availability[saturday_end]"]').val()
        }
        formdata.append('availability', JSON.stringify(obj))
        console.log(obj)
        if ($('#timezone').val() != '') {
            formdata.append('timezone', $('#timezone').val())
            if ($('#mdp-demo').val() != '') {
                console.log("dsd " + $('#mdp-demo').val())
                formdata.append('special_days_off', $('#mdp-demo').val())
                if ($('#firstdayweek').val() != '') {
                    formdata.append('notice_each_book_day', $('#firstdayweek').val())
                } else {
                    if ($('#notice').val() != '') {
                        formdata.append('notice_each_book_ans', $('#notice').val())
                        if ($('#secdayweek').val() != '') {
                            formdata.append('advance_book_day', $('#secdayweek').val())
                        } else {
                            if ($('#secdayweek').val() != '') {
                                formdata.append('advance_book_ans', $('#addvance').val())
                            } else {

                            }
                        }
                    } else {

                    }
                }
            } else {

            }
        } else {

        }
        //   }
        //   else{

        //   }
    })


    $('#step4_next').click(function() {
        $(".error").empty();

        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        $('.bsunstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time) {
                //console.log(time)
                var newt = moment(time, 'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bsunendtimepicker').timepicker('destroy')
                $('.bsunendtimepicker').timepicker({
                    timeFormat: 'h:mm p',
                    minTime: newt,
                    interval: 30,
                    startTime: '00:00',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true,
                });
            }
        });

        $('.bsunendtimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });

        $('.bmonstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time) {
                //console.log(time)
                var newt = moment(time, 'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bmonendtimepicker').timepicker('destroy')
                $('.bmonendtimepicker').timepicker({
                    timeFormat: 'h:mm p',
                    minTime: newt,
                    interval: 30,
                    startTime: '00:00',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true,
                });
            }
        });

        $('.bmonendtimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });

        $('.btuesstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time) {
                //console.log(time)
                var newt = moment(time, 'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.btuesendtimepicker').timepicker('destroy')
                $('.btuesendtimepicker').timepicker({
                    timeFormat: 'h:mm p',
                    minTime: newt,
                    interval: 30,
                    startTime: '00:00',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true,
                });
            }
        });

        $('.btuesendtimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        $('.bwedstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time) {
                //console.log(time)
                var newt = moment(time, 'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bwedendtimepicker').timepicker('destroy')
                $('.bwedendtimepicker').timepicker({
                    timeFormat: 'h:mm p',
                    minTime: newt,
                    interval: 30,
                    startTime: '00:00',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true,
                });
            }
        });

        $('.bwedendtimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        $('.bthrusstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time) {
                //console.log(time)
                var newt = moment(time, 'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bthrusendtimepicker').timepicker('destroy')
                $('.bthrusendtimepicker').timepicker({
                    timeFormat: 'h:mm p',
                    minTime: newt,
                    interval: 30,
                    startTime: '00:00',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true,
                });
            }
        });

        $('.bthrusendtimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        $('.bfristarttimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time) {
                //console.log(time)
                var newt = moment(time, 'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bfriendtimepicker').timepicker('destroy')
                $('.bfriendtimepicker').timepicker({
                    timeFormat: 'h:mm p',
                    minTime: newt,
                    interval: 30,
                    startTime: '00:00',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true,
                });
            }
        });

        $('.bfriendtimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        $('.bsatstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time) {
                //console.log(time)
                var newt = moment(time, 'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bsatendtimepicker').timepicker('destroy')
                $('.bsatendtimepicker').timepicker({
                    timeFormat: 'h:mm p',
                    minTime: newt,
                    interval: 30,
                    startTime: '00:00',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true,
                });
            }
        });

        $('.bsatendtimepicker').timepicker({
            timeFormat: 'h:mm p',
            // minTime: '2:00 AM',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        if ($('#testdemo').val() != null) {

            console.log(JSON.stringify($("#testdemo").val()))
            formdata.append('languages', JSON.stringify($("#testdemo").val()))
            if ($('#train_to').val() != null) {
                formdata.append('train_to', JSON.stringify($("#train_to").val()))
                if ($('#personality').val() != null) {
                    formdata.append('experience_level', JSON.stringify($("#personality").val()))
                    if ($('#personality_type').val() != null) {
                        formdata.append('personality', JSON.stringify($("#personality_type").val()))
                        if ($('#skill').val() != null) {
                            formdata.append('skill_lavel', JSON.stringify($("#skill").val()))
                            if ($('#where_choose').val() != null) {
                                formdata.append('work_locations', JSON.stringify($("#where_choose").val()))
                                if ($('input[name="medical_states"]:checked').val() != 0) {
                                    if ($('#mcc').val() == null) {
                                        showSystemMessages('#systemMessage1', 'danger', 'Please select data');
                                        //$("#b_mcc").text("Please select data");
                                    } else {
                                        if ($('input[name="fitness_goals"]:checked').val() != 0) {
                                            if ($('#fitness_goals_array').val() == null) {
                                                showSystemMessages('#systemMessage1', 'danger', 'Please select data');
                                                //$("#b_fitness_goals_array").text("Please select data");
                                            } else {
                                                formdata.append('medical_states', $('input[name="medical_states"]:checked').val())
                                                formdata.append('goals_states', $('input[name="fitness_goals"]:checked').val())
                                                formdata.append('goals_option', JSON.stringify($('#fitness_goals_array').val()))
                                                formdata.append('medical_type', JSON.stringify($("#mcc").val()))
                                                $('#step4').hide();
                                                $('#step5').show();
                                            }
                                        } else {
                                            formdata.append('medical_states', $('input[name="medical_states"]:checked').val())
                                            formdata.append('goals_states', $('input[name="fitness_goals"]:checked').val())
                                            formdata.append('goals_option', $('#fitness_goals_array').val())
                                            formdata.append('medical_type', $("#mcc").val())
                                            $('#step4').hide();
                                            $('#step5').show();
                                        }
                                    }
                                } else {
                                    if ($('input[name="fitness_goals"]:checked').val() != 0) {
                                        if ($('#fitness_goals_array').val() == null) {
                                            // $("#b_fitness_goals_array").text("Please select data");
                                            showSystemMessages('#systemMessage1', 'danger', 'Please select data');
                                        } else {
                                            formdata.append('medical_states', $('input[name="medical_states"]:checked').val())
                                            formdata.append('goals_states', $('input[name="fitness_goals"]:checked').val())
                                            formdata.append('goals_option', $('#fitness_goals_array').val())
                                            formdata.append('medical_type', $("#mcc").val())
                                            console.log(formdata.values())
                                        }
                                    } else {
                                        formdata.append('medical_states', $('input[name="medical_states"]:checked').val())
                                        formdata.append('goals_states', $('input[name="fitness_goals"]:checked').val())
                                        formdata.append('goals_option', $('#fitness_goals_array').val())
                                        formdata.append('medical_type', $("#mcc").val())
                                        console.log(formdata.values())
                                        $('#step4').hide();
                                        $('#step5').show();
                                        $('#step4').hide();
                                        $('#step5').show();
                                        $('#mdp-demo').multiDatesPicker({
                                            separator: ", ",
                                            onSelect: function(dateText, inst) {
                                                $('.rounded-corner').each(function(i, obj) {
                                                    console.log($(this))
                                                    if ($(this).text() == dateText + ' x') {
                                                        console.log("if")
                                                        $(this).click()
                                                    }
                                                });
                                                $('.manual-remove').append('<button type="button" date="' + dateText + '" class="rounded-corner">' + dateText + ' x</button>')
                                            }

                                        });
                                        //   $('#markcalendar').click(function() {
                                        //       $("#mdp-demo").focus();
                                        //     });
                                    }
                                }
                            } else {
                                showSystemMessages('#systemMessage1', 'danger', 'Please select where do you work with clients');
                                //$("#b_where_choose").text("Please select where do you work with clients");
                            }
                        } else {
                            showSystemMessages('#systemMessage1', 'danger', 'Please select skill');
                            // $("#b_skill").text("Please select skill");
                        }
                    } else {
                        showSystemMessages('#systemMessage1', 'danger', 'Please select personality type');
                        // $("#b_personality_type").text("Please select personality type"); 
                    }
                } else {
                    showSystemMessages('#systemMessage1', 'danger', 'Please select service experience');
                    //$("#b_personality").text("Please select service experience"); 
                }
            } else {
                showSystemMessages('#systemMessage1', 'danger', 'Please select who you work with');
                //$("#b_train_to").text("Please select who you work with"); 
            }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Please select languages you and your staff speak');
            //$("#b_testdemo").text("Please select languages you and your staff speak"); 
        }
        // $('#step4').hide();$('#step5').show();
        formdata.append('medical_states', $('input[name="medical_states"]:checked').val())
        formdata.append('goals_states', $('input[name="fitness_goals"]:checked').val())
        formdata.append('goals_option', JSON.stringify($('#fitness_goals_array').val()))
        formdata.append('medical_type', JSON.stringify($("#mcc").val()))
        //   $('#step4').hide();$('#step5').show();
    })

    // $('#create_company_btn').click(function(){
    //     $('#CreateCompanyModal').modal('show');
    //     //$('#company_intro').hide();$('#step5').show()
    // })

    $('#education_skill_next').click(function() {


        $(".error").empty();
        // if($('#frm_organisationname').val() != ''){
        // if($('#frm_position').val() != ''){
        // if($('#dp1').val() != ''){
        // if($('#dp2').val() != ''){
        // if($("#frm_course").val()!=''){
        // if($("#frm_university").val()!=''){
        //if($("#passingyear").val()!=''){
        // if($("#certification").val()!=''){
        //     if($("#completionyear").val()!=''){
        //             if($("#skiils_achievments_awards1").val()!=''){

        if ($('#passingyear').val() <= new Date().getFullYear()) {
            // if($("#skillcompletionpicker").val()!=''){
            formdata.append('organization', $("input:text[name='frm_organization']").val())
            formdata.append('position', $("input:text[name='frm_position']").val())
            formdata.append('service_start', $("input:text[name='frm_servicestart']").val())
            formdata.append('service_end', $("input:text[name='frm_serviceend']").val())
            formdata.append('is_present', $("#frm_ispresent").val())
            formdata.append('course', $("#frm_course").val())
            formdata.append('university', $("#frm_university").val())
            formdata.append('passing_year', $("#passingyear").val())
            formdata.append('title', $("#certification").val())
            formdata.append('completion_date', $("#completionyear").val())
            formdata.append('type', $("#skiils_achievments_awards1").val())
            formdata.append('skill_completion_date', $("#skillcompletionpicker").val())
            formdata.append('skill_detail', $("#frm_skilldetail").val())

            $('#prev_degree').text($("#frm_course").val())
            $('#prev_university').text($("#frm_university").val())
            $('#prev_yeargraduate').text($("#passingyear").val())
            $('#prev_nameofcertification').text($("#certification").val())
            $('#prev_completiondate').text($("#completionyear").val())
            $('#prev_skilltype').text($("#skiils_achievments_awards").val())
            $('#prev_skilldetail').text($("#frm_skilldetail").val())
            $('#prev_skillcompletion').text($("#skillcompletionpicker").val())
            $('#prev_organisationname').text($("input:text[name='frm_organization']").val())
            $('#prev_position').text($("input:text[name='frm_position']").val())
            $('#prev_servicestart').text($("#dp1").val())
            $('#prev_serviceend').text($("#dp2").val())
            $('#company_education_skill').hide();
            $('#step4').show();
            //}
            //   else{
            //       showSystemMessages('#systemMessage1', 'danger', 'Please Enter the skill completion date.');

            // }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Passing Year shoud be less than current year');

        }
        //             }
        //             else{
        //                 showSystemMessages('#systemMessage1', 'danger', 'Please select skill type');

        //             }
        //     }else{
        //         showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Certication completion date');

        //     }
        // }else{
        //     showSystemMessages('#systemMessage1', 'danger', 'Please Enter the certification');

        // }
        //             }
        //             else{
        //     showSystemMessages('#systemMessage1', 'danger', 'Please select passing year');
        //   }

        //     }
        //     else{
        //   showSystemMessages('#systemMessage1', 'danger', 'Please Enter the university');

        //     }
        // }
        // else{
        // showSystemMessages('#systemMessage1', 'danger', 'Please enter the course');

        // }

        // }else{
        // showSystemMessages('#systemMessage1', 'danger', 'Please enter the To Date');

        // } 
        // }else{
        // showSystemMessages('#systemMessage1', 'danger', 'PPlease enter the From Date');

        // }    
        // }else{
        // showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Position');

        // }    
        // }else{
        // showSystemMessages('#systemMessage1', 'danger', 'Please Enter the organistaion name');

        // }

    })

    $('#b_business_user_tag').change(function() {
        var v = $(this).val();
        ajax(v)
    });
    var verr = ''

    function ajax(v) {
        if (v != '') {
            $.ajax({
                url: '/mybusinessusertag',
                type: 'POST',
                dataType: 'json',
                data: {
                    email: v
                },
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                success: function(response) {

                    if (response.count != 0) {
                        // $(".b_eml").text(response.msg).show();
                        //setTimeout(function(){ $(".b_eml").hide(); }, 4000);
                        verr = 'This tag has already taken, choose another one.'
                        showSystemMessages('#systemMessage1', 'danger', 'This tag has already taken, choose another one.');
                        // $('#b_usertag').text('This tag has already taken, choose another one.');
                    } else {
                        verr = ''
                        $('#b_usertag').text('')
                    }
                }
            });
        }
    }

    $("#b_Establishmentyear").change(function() {
        //console.log("ggfh")
        var a = $("#b_Establishmentyear").val();
        if (a > new Date().getFullYear()) {
            showSystemMessages('#systemMessage1', 'danger', 'Establishment Year shoud be less than current year.');
            // $("#b_estb").text("Establishment Year shoud be less than current year");
        } else {
            $("#b_estb").text("");
        }
    })
    $("#passingyear").change(function() {
        //console.log("ggfh")
        var a = $("#passingyear").val();
        if (a > new Date().getFullYear()) {
            showSystemMessages('#systemMessage1', 'danger', 'Passing year shoud be less than current year.');
            // $("#b_year").text("Passing year shoud be less than current year");
        } else {
            $("#b_year").text("");
        }
    })
    $("#company_info_next").click(function() {
        $(".error").empty();
        ajax($('#b_business_user_tag').val())
        $('#b_usertag').change()
        if ($("#b_companyname").val() != '') {
            if ($("#b_address").val() != '') {
                if ($("#b_state").val() != '') {
                    if ($("#b_city").val() != '') {
                        if ($("#b_zipcode").val() != '') {
                            if ($("#b_country").val() != '') {
                                if ($("#b_EINnumber").val() != '') {
                                    if ($('#b_Establishmentyear').val() != "") {
                                        if ($('#b_business_user_tag').val() != "") {
                                            if ($('#b_Establishmentyear').val() <= new Date().getFullYear()) {
                                                console.log($('#b_estb').text())

                                                if (verr == '' && $("#b_estb").text() == '') {
                                                    console.log("rwre")
                                                    $('#prev_companyname').text($("#b_companyname").val())
                                                    $('#prev_einnumber').text($("#b_EINnumber").val())
                                                    $('#prev_establishmentyear').text($("#b_Establishmentyear").val())
                                                    $('#prev_address').text($("#b_address").val())
                                                    $('#prev_state').text($("#b_state").val())
                                                    $('#prev_city').text($("#b_city").val())
                                                    $('#prev_zipcode').text($("#b_zipcode").val())
                                                    $('#prev_country').text($("#b_country").val())
                                                    $('#prev_business_user_tag').text($("#b_business_user_tag").val())
                                                    formdata.append('company_name', $("#b_companyname").val())
                                                    formdata.append('address', $("#b_address").val())
                                                    formdata.append('state', $("#b_state").val())
                                                    formdata.append('city', $("#b_city").val())
                                                    formdata.append('zipcode', $("#b_zipcode").val())
                                                    formdata.append('ein_number', $("#b_EINnumber").val())
                                                    formdata.append('establishment_year', $("#b_Establishmentyear").val())
                                                    formdata.append('country', $("#b_country").val())
                                                    formdata.append('business_user_tag', $("#b_business_user_tag").val())
                                                    formdata.append('latitude', lat)
                                                    formdata.append('longitude', long)
                                                    $('#company_info').hide();
                                                    $('#company_education_skill').show();
                                                }
                                            } else {
                                                showSystemMessages('#systemMessage1', 'danger', 'Establishment Year shoud be less than current year');
                                                // $("#b_estb").text("Establishment Year shoud be less than current year");
                                            }

                                        } else {
                                            showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Business User Tag');
                                            //$("#b_usertag").text("Please Enter the Business User Tag ");
                                        }

                                    } else {
                                        showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Establishment Year');
                                        //$("#b_estb").text("Please Enter the Establishment Year ");
                                    }
                                } else {
                                    showSystemMessages('#systemMessage1', 'danger', 'Please Enter the EIN number');
                                    // $("#b_ein").text("Please Enter the EIN number");
                                }
                            } else {
                                showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Country name');
                                //$("#b_cont").text("Please Enter the Country name ");
                            }
                        } else {
                            showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Zip code');
                            //$("#b_zip").text("Please Enter the Zip code ");
                        }
                    } else {
                        showSystemMessages('#systemMessage1', 'danger', 'Please Enter the City');
                        //$("#b_ct").text("Please Enter the City");
                    }
                } else {
                    showSystemMessages('#systemMessage1', 'danger', 'Please Enter the State');
                    //$("#b_sta").text("Please Enter the State");
                }
            } else {
                showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Address');
                //$("#b_addr").text("Please Enter the Address ");
            }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Company');
            //$("#b_cmpo").text("Please Enter the Company");
        }

    })

    $('#company_intro_next').click(function() {
        $(".error").empty();
        if (profile_pic_var != '') {
            if ($("#b_firstname").val() != '') {
                if ($("#b_lastname").val() != '') {
                    if ($("#b_email").val() != '') {
                        if (($("#b_contact").val() != '') && ($("#b_contact").val().length >= 10)) {
                            if ($('#about_company').val() != null && $('#about_company').val() != '' && $('#about_company').val() != ' ') {
                                if ($('#short_description').val() != null && $('#short_description').val() != '' && $('#short_description').val() != ' ') {
                                    formdata.append('company_representative_first_name', $("#b_firstname").val())
                                    formdata.append('company_representative_last_name', $("#b_lastname").val())
                                    formdata.append('email', $("#b_email").val())
                                    formdata.append('about_company', $("#about_company").val())
                                    formdata.append('short_description', $("#short_description").val())
                                    formdata.append('contact_number', $("#b_contact").val())
                                    formdata.append('profile_pic', profile_pic_var)
                                    $('#prev_firstname').text($("#b_firstname").val())
                                    $('.prev_firstname').text($("#b_firstname").val())
                                    $('#prev_lastname').text($("#b_lastname").val())
                                    $('.prev_lastname').text($("#b_lastname").val())
                                    $('#prev_email').text($("#b_email").val())
                                    $('#prev_contact').text($("#b_contact").val())
                                    $('#company_intro').css('display', 'none');
                                    $('#company_info').css('display', 'block');
                                } else {
                                    showSystemMessages('#systemMessage1', 'danger', 'Please Enter the About Comapny Short Description');
                                }

                            } else {
                                showSystemMessages('#systemMessage1', 'danger', 'Please Enter the About Comapny');
                            }
                        } else {
                            showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Contact number');
                            // $("#b_cot").text("Please Enter the Contact number ");
                        }
                    } else {
                        showSystemMessages('#systemMessage1', 'danger', 'Please Enter the email');
                        //  $("#b_eml").text("Please Enter the email");
                    }
                } else {
                    showSystemMessages('#systemMessage1', 'danger', 'Please Enter the lastname');
                    //$("#b_ln").text("Please Enter the lastname ");
                }

            } else {
                showSystemMessages('#systemMessage1', 'danger', 'Please Enter the firstname');
                // $("#b_fn").text("Please Enter the firstname ");
            }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Please upload profile picture');
            // $("#b_profile").text("Please upload profile picture ");
        }
        //$('#company_intro').css('display','none');$('#company_info').css('display','block');
    })
    //})
    $('.multi-level-dropdown .dropdown-submenu > a').on("mouseenter", function(e) {
        var submenu = $(this);
        $('.multi-level-dropdown .dropdown-submenu .dropdown-menu').removeClass('show');
        submenu.next('.dropdown-menu').addClass('show');
        e.stopPropagation();
    });

    $('.multi-level-dropdown .dropdown').on("hidden.bs.dropdown", function() {
        // hide any open menus when parent closes
        $('.multi-level-dropdown .dropdown-menu.show').removeClass('show');
    });
    $('.clsbtn').click(function() {
        $('.search').toggle();
    });
    //});

</script>
