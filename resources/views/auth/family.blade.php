@extends('layouts.app')

@section('content')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css" rel="stylesheet"/>
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" rel="stylesheet"/>
<script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.src.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<style>
    .row{
        margin-top:5px;
    }
</style>
<style>
.btn-info{
    background:#f53b49;
    border-color:#f53b49;
}
    .Zebra_DatePicker {
    background: #666;
    border-radius: 4px;
    box-shadow: 0 0 10px #888;
    color: #222;
    font: 13px Tahoma,Arial,Helvetica,sans-serif;
    padding: 3px;
    position: absolute;
    display: table;
    *width: 255px;
    z-index: 1200
}
.Zebra_DatePicker *,
.Zebra_DatePicker :after,
.Zebra_DatePicker :before {
    box-sizing: content-box!important
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
        font-family: 'Segoe UI Symbol',Tahoma,Arial,Helvetica,sans-serif
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
    background: #fc3;
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
</style>
<script> 
    $(function() { 
        // $( "#my_date_picker" ).datepicker({ 
        //      format: 'yy/mm/dd',
        // }); 
        $('#my_date_picker').Zebra_DatePicker({
        default_position: 'below',
        container : $('#datepicker-position')      
});
        // $('#my_date_picker').multiDatesPicker({
        //     dateFormat: "yy-mm-dd",
        //     onSelect: function(dateText, inst) { $("#my_date_picker").val(dateText) }
        // });
    }); 
</script> 
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 well">
        @if(!(@$error_msg))
         <div id='systemMessage'></div>
        <h4>Complete your profile</h4>
        <h5>Please add one family member and rest you can add from profile.</h5>
        <form id="frm_register" method="post">
        <div class="row">
            <div class="col-sm-4">First Name</div>
            <div class="col-sm-8"><input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name"></div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">Last Name</div>
            <div class="col-sm-8"><input type="text" class="form-control" placeholder="Last Name" name="last_name"></div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">Relationship</div>
            <div class="col-sm-8">
                <select class="form-control" name="relationship">
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
            </div>
        </div>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <div class="row">
            <div class="col-sm-4">Mobile Phone</div>
            <div class="col-sm-8"><input maxlength="10" type="text" placeholder="Mobile Phone" class="form-control" id="mobile" name="mobile"></div>
        </div>
        
         <div class="row">
            <div class="col-sm-4">Emergency Contact Number</div>
            <div class="col-sm-8"><input maxlength="10" type="text" placeholder="Emergency Contact Number" class="form-control" id="emergency_contact" name="emergency_contact"></div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">Gender</div>
            <div class="col-sm-8">
                <select class="form-control" name="gender">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                 </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">Email</div>
            <div class="col-sm-8"><input type="email" placeholder="Email" class="form-control" name="email"></div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">Birthday</div>
            <div class="col-sm-8" id="datepicker-position"><input autocomplete="off" class="form-control" placeholder="Select Birthday" name="birthday" id="my_date_picker"></div>
        </div>
        <div class="col-sm-12 text-right" style="margin-top:10px;">
            <button type="button"  style="margin:0px;" class="signup-new button" user_id={{$user_id}} id="register_submit-skip">SKIP</button>
            <button type="button"  style="margin:0px;" class="signup-new button" id="register_submit" onclick="$('#frm_register').submit();">SAVE</button>
        </div>
        @else
            <h3>{{@$error_msg}}</h3>
        @endif
    </div>
    <div class="col-sm-3"></div>
</div>
@endsection
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>


<!-- Latest compiled JavaScript -->
<script  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    
      $("#register_submit").click(function(){
           
        $('#frm_register').submit();
      });
      
      $("#register_submit-skip").click(function(){
          
           var posturl = '/submit-family-form-with-skip';
            $.ajax({
              url:posturl,
              type:'POST',
              dataType: 'json',
              data:{"user_id":$(this).attr('user_id'),"_token":"{{csrf_token()}}"},
              beforeSend: function () {
                $('#register_submit').prop('disabled', true);
                showSystemMessages('#systemMessage', 'info', 'Please wait....');
              },
              complete: function () {
                $('#register_submit').prop('disabled', true);
              },
              success: function (response) {
                  showSystemMessages('#systemMessage', response.type, response.msg);
                  if(response.type === 'success'){
                    window.location.href = response.redirecturl;
                  }else{
                    $('#register_submit').prop('disabled', false);    
                  }
                }
            });
      
      });

    $("#frm_register").submit(function(e){
console.log("called")
        e.preventDefault();
          // check for validation
          $('#frm_register').validate({
              rules: {
                  first_name: "required",
                  last_name: "required",
                  emergency_contact: {
                    //required: true,
                    maxlength: 10,
                    minlength: 10,
                  },
                  birthday: "required",
                  email: {
                    required: true,
                    email: true
                  },
                  mobile:{
                      required:true,
                       maxlength: 10,
                    minlength: 10,
                  },
                  gender: "required",
                  relationship: "required",
              },
              messages: {
                  first_name: "Enter First Name",
                  last_name: "Enter Last Name",
                  mobile:{
                      required:"Enter Mobile",
                       minlength: "Please enter a valid contact number",
                    maxlength: "Please enter a valid contact number",
                  }, 
                  birthday: "Enter Birth Date",
                  email: {
                    required: "Please enter a valid email address",
                    minlength: "Please enter a valid email address",
                },
                emergency_contact: {
                   // required: "Please enter contact number",
                    minlength: "Please enter a valid contact number",
                    maxlength: "Please enter a valid contact number",
                },
                gender: "Select gender",
                relationship: "Select relationship",
              },
              submitHandler: registerUser
        });
       // return;
  });
});
  function registerUser() {
    console.log("function called")
        $('#register_submit').prop('disabled', true);
        var validForm = $('#frm_register').valid();
        var posturl = '/submit-family-form';

        if (validForm) {

          var formData = $("#frm_register").serialize();
            //formData.append("_token","{{csrf_token()}}")
          
          $.ajax({
              url:posturl,
              type:'POST',
              dataType: 'json',
              data:formData,
              beforeSend: function () {
                $('#register_submit').prop('disabled', true);
                showSystemMessages('#systemMessage', 'info', 'Please wait while we submitting the data');
              },
              complete: function () {
                $('#register_submit').prop('disabled', true);
              },
              success: function (response) {
                  showSystemMessages('#systemMessage', response.type, response.msg);
                  if(response.type === 'success'){
                    window.location.href = response.redirecturl;
                  }else{
                    $('#register_submit').prop('disabled', false);    
                  }
                }
            });
        }
}
      //});


</script>