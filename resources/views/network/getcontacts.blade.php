@extends('layouts.profile')

@section('content')

<style type="text/css">
  .review-list-block{margin-top: 10px;}
</style>

<script src="//js.live.net/v5.0/wl.js"></script>
<script type="text/javascript">
WL.init({
    client_id: "00000000441D15E3",
    redirect_uri: "http://fitnessity.thewebpatriot.com/network/getcontacts",
    // redirect_uri: "http://localhost:8080/network/getcontacts",
    scope: ["wl.basic", "wl.contacts_emails"],
    response_type: "token"
});

$( document ).ready(function() {

  //check if contacts imported already
  // $('#existingcontactlistDiv').hide();
  // $('#contactlistDiv').hide();
  // $('#norecordDiv').hide();
  
  var existingContacts = <?php echo count($existingContacts);?>;
  var gmailContacts = <?php echo count($gmailContacts);?>;
  if(existingContacts > 0) {
    $('#existingcontactlistDiv').show();
    $('#selectalldiv_existingcontacts').show();
  }
  if(gmailContacts > 0) {
    $('#contactlistDiv').show();
    $('#selectalldiv_contacts').show();
  }
 
  //live.com api
  $('#import').click(function(e) {
      e.preventDefault();

      var href = $('#gmail_btn').attr('href');
      $('#gmail_btn').attr('href', 'javascript:void(0)');
      $(".container").css('opacity', '0.5');

      WL.login({
          scope: ["wl.basic", "wl.contacts_emails"]
      }).then(function (response) 
      {
      WL.api({
              path: "me/contacts",
              method: "GET"
          }).then(
              function (response) {
                //your response data with contacts 
                $('#invitebyemail').hide();
                if(response.data.length > 0) {                  
                  // filter contact for existing fitnessity members
                  $.ajax({
                    url: '/network/filterregisteredcontacts',
                    type:'POST',
                    dataType: 'json',
                    data: { 'data' : response.data, '_token': $("input[name='_token']").val()},
                    beforeSend: function () {
                      // $('#gmail_btn').prop('disabled', true);
                    },
                    complete: function () {
                      $('#gmail_btn').attr('href', href);
                      $(".container").css('opacity', '1');
                    },
                    success: function (contacts) {
                      $('#existingcontactlist').empty();
                      var html2 = '';
                      if(Object.keys(contacts.data.existingContacts).length > 0) {
                        $.each(contacts.data.existingContacts, function(i, contact) {
                           html2 +='<div class="form-control" id="existingcontact_'+contact.id+'">'
                                +'<div class="btn-group" data-toggle="buttons">'
                                  +'<i class="fa fa-check checkmark" style="display:none;"></i>'
                                    +'<label class="btn btn-primary active">'
                                      +'<input type="checkbox" name="fitnessitycontacts[]" value="'+contact.id+'" class="chk" autocomplete="off" checked>'
                                      +'<span class="glyphicon glyphicon-ok"></span>'
                                    +'</label>'
                                    +'<span class="qh-lbl">' + contact.firstname +' '+ contact.firstname + ' (' + contact.email +')</span>'
                                +'</div>'
                              +'</div>';
                        });
                      $('#existingcontactlistDiv').show();
                      $('#selectalldiv_existingcontacts').show();
                      $('#existingcontactlist').append(html2);
                      }

                      $('#contactlist').empty(); 
                      var html = '';
                      console.log(contacts.data.contacts);
                      if(Object.keys(contacts.data.contacts).length > 0) {
                        $.each(contacts.data.contacts, function(i, contact) {
                          if(contact.email != '') {
                            html +='<div class="form-control">'
                                +'<div class="btn-group" data-toggle="buttons">'
                                  +'<i class="fa fa-check checkmark" style="display:none;"></i>'
                                    +'<label class="btn btn-primary active">'
                                      +'<input type="checkbox" name="gmailcontacts[]" value="'+contact.email+'" class="chk" autocomplete="off" checked>'
                                      +'<span class="glyphicon glyphicon-ok"></span>'
                                    +'</label>'
                                    +'<span class="qh-lbl">' + contact.first_name + ' (' + contact.email +')</span>'
                                +'</div>'
                              +'</div>';
                            }                          
                        });
                        $('#contactlist').append(html);
                        $('#contactlistDiv').show();
                        $('#selectalldiv_contacts').show();
                      }else {
                       $('#norecordDiv').show();
                      }
                    }
                  });
                }
              },
              function (responseFailed) {
                $('#gmail_btn').attr('href', href);
                $(".container").css('opacity', '1');
                console.log(responseFailed.error.message);
                alert(responseFailed.error.message);
              }
          );
          
      },
      function (responseFailed) 
      {
          //console.log("Error signing in: " + responseFailed.error_description);
          $('#gmail_btn').attr('href', href);
          $(".container").css('opacity', '1');
          alert(responseFailed.error_description);
      });
  });    
 
});
</script>

<?php $loggedinUser = Auth::user(); ?>
<?php session_start(); ?>

<div class="business-offer-main">
  @include('includes.sidebar_profile_left')

  <div class="business-middle">

    @include('includes.network_tab_menu')

    <div class="busines-offer-list busines-off-profile-list">

      <div class="network_block">
        <!-- <div class="container"> -->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="">
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <h2>INVITE YOUR FRIENDS TO JOIN FITNESSITY</h2>
                         <br>
                         <p>See who you already know on Fitnessity. Have a friend who would love being a part of the worlds #1fitness community? Need a little extra motivation and encouragement? Invite your friends to join you in a lesson, class or adventure. We won’t email your contacts without your permission, so don’t worry. </p>
                         <br>
                                                  
                         <p><h4>Choose one to import contacts</h4></p>
                         <br>
                         <div class="gmaildiv">
                            <a id="gmail_btn" title="Gmail" href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo env('GOOGLE_CLIENT_ID'); ?>&redirect_uri=<?php echo env('GOOGLE_REDIRECT_URI'); ?>&scope=https://www.google.com/m8/feeds/&response_type=code"">
                              <img src="/images/gmail.png" border="0" class="img-bg">
                            </a>
                            <a title="Outlook" href="javascript:void(0)" id="import">
                              <img src="/images/outlook.png" border="0" class="img-bg">
                            </a>
                            <a title="Invite by Email" href="javascript:void(0)" id="invitybyemail">
                              <img src="/images/email.png" border="0" class="img-bg">
                            </a>
                          </div>
                       <br>
                      </div>
                     
                    </div>
                 </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="systemMessage_network"></div>
                <br><br>

                <!-- invite by email -->
                <div class="leftpadding40 toppadding40" id="invitebyemail" style="display:none;">
                  <form method="post" id="frminvitation_email">
                    {!! csrf_field() !!}
                    
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12"></div>
                    <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                    <h4>Directly invite your email contacts to connect on Fitnessity</h4>
                    <br>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 qh-steps-form">
                                <div class="form-control" id="selectalldiv_existingcontacts">
                                    <div class="" data-toggle="buttons">
                                      <textarea name="inviteemail" id="inviteemail" style="width:100%;" placeholder="Enter email addresses here, separated by comma"></textarea>
                                    </div>
                                  </div>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                              <div class="act-btn">
                                <span class="review-rate-block">
                                  <button type="submit" style="float:right;" class="header-right-menu" value="Send Friends Request" id="sendinviteemail">Send Invitation</button>
                                </span>
                              </div>
                          </div>
                    </div>
                  </form>
                </div>                

                <br><br>
                 <!-- already registered contacts -->
                 <div class="review-list-block leftpadding40" id="existingcontactlistDiv" style="display:none;">
                    <div class="row">
                      <form method="post" id="frmfrndreq">
                        {!! csrf_field() !!}
                          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 qh-steps-form">
                                <div class="form-control" id="selectalldiv_existingcontacts" style="display:none">
                                    <div class="btn-group" data-toggle="buttons">
                                        <i class="fa fa-check checkmark" style="display:none;"></i>
                                        <label class="btn btn-primary active" id="selectall_existingcontacts">
                                          <input type="checkbox" class="chk" autocomplete="off" checked>
                                          <span class="glyphicon glyphicon-ok"></span>
                                        </label>
                                        <span class="qh-lbl" style="color:#f53b49;font-weight:bold;">SELECT ALL</span>
                                    </div>
                                  </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="act-btn">
                                <span class="review-rate-block">
                                  <button type="submit" style="float:right;" class="header-right-menu" value="Send Friends Request" id="senfrndreq">Send Friends Request</button>
                                </span>
                              </div>
                          </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div id="existingcontactlist" class="qh-steps-form">
                            @if(count($existingContacts) > 0)
                              @foreach($existingContacts as $contact)
                                <div class="form-control" id="existingcontact_{{$contact['id']}}">
                                  <div class="btn-group" data-toggle="buttons">
                                      <i class="fa fa-check checkmark" style="display:none;"></i>
                                      <label class="btn btn-primary active">

                                        <input type="checkbox" name="fitnessitycontacts[]" value="{{ $contact['id'] }}" class="chk" autocomplete="off" checked>
                                        <span class="glyphicon glyphicon-ok"></span>
                                      </label>
                                      <span class="qh-lbl">{{ $contact['firstname'] }} {{ $contact['lastname'] }} ({{ $contact['email'] }})</span>
                                  </div>
                                </div>
                              @endforeach
                            @endif
                          </div>
                        </div>                  
                      </form> 
                    </div>
                 </div>

                 <!-- <div class="review-list-block"></div> -->

                 <div class="review-list-block qh-content-block leftpadding40" id="norecordDiv" style="display:none;">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="qh-steps-form">
                          <div class="form-control">
                              <div class="btn-group" data-toggle="buttons">
                                  <span class="qh-lbl">No Contacts Found To Invite</span>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                 </div>
                 
                 <!-- imported contact list -->
                 <div class="review-list-block qh-content-block leftpadding40" id="contactlistDiv" style="display:none;">
                    <div class="row">
                      <form method="post" id="frminvitation">
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 qh-steps-form">
                              <div class="form-control" id="selectalldiv_contacts" style="display:none">
                                  <div class="btn-group" data-toggle="buttons">
                                      <i class="fa fa-check checkmark" style="display:none;"></i>
                                      <label class="btn btn-primary active" id="selectall_contactlist">
                                        <input type="checkbox" class="chk" autocomplete="off" checked>
                                        <span class="glyphicon glyphicon-ok"></span>
                                      </label>
                                      <span class="qh-lbl" style="color:#f53b49;font-weight:bold;">SELECT ALL</span>
                                  </div>
                                </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                              <div class="act-btn">
                                  <span class="review-rate-block">
                                    <button type="submit" style="float:right;" class="header-right-menu" value="Invite Friends" id="invitefrnd">Invite Friends</button>
                                  </span>
                              </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            {!! csrf_field() !!}
                              <div id="contactlist" class="qh-steps-form">
                                <div class="form-control">
                                  <div class="btn-group" data-toggle="buttons">
                                      <i class="fa fa-check checkmark" style="display:none;"></i>
                                      <label class="btn btn-primary active">
                                        <input type="checkbox" name="gmailcontacts[]" value="testfit@yopmail.com" class="chk" autocomplete="off" checked>
                                        <span class="glyphicon glyphicon-ok"></span>
                                      </label>
                                      <span class="qh-lbl">testfit@yopmail.com (testfit@yopmail.com)</span>
                                  </div>
                                </div>
                                <div class="form-control">
                                  <div class="btn-group" data-toggle="buttons">
                                      <i class="fa fa-check checkmark" style="display:none;"></i>
                                      <label class="btn btn-primary active">
                                        <input type="checkbox" name="gmailcontacts[]" value="testfit123@yopmail.com" class="chk" autocomplete="off" checked>
                                        <span class="glyphicon glyphicon-ok"></span>
                                      </label>
                                      <span class="qh-lbl">testfit123@yopmail.com (testfit123@yopmail.com)</span>
                                  </div>
                                </div>
                              @if(count($gmailContacts) > 0)
                                @foreach($gmailContacts as $contact)
                                    <div class="form-control"">
                                      <div class="btn-group" data-toggle="buttons">
                                          <i class="fa fa-check checkmark" style="display:none;"></i>
                                          <label class="btn btn-primary active" data-tmpid="{{$contact['tmpid']}}">
                                            <input type="checkbox" name="gmailcontacts[]" value="{{$contact['email']}}" class="chk" autocomplete="off" checked>
                                            <span class="glyphicon glyphicon-ok"></span>
                                          </label>
                                          <span class="qh-lbl">{{ $contact['name'] }} ({{ $contact['email'] }})</span>
                                      </div>
                                    </div>
                                @endforeach
                              @endif
                              </div>
                          </div>
                      </form>
                    </div>
                 </div>

            </div>
          </div>
        <!-- </div> -->
      </div>

    </div>
     <p>Note: Choosing a service will open a window for you to log in securely and import your contacts to Fitnessity. We won’t email anyone without your consent, but we may use your contact information to make connecting with friends faster for better experience. You can remove you contacts from Fitnessity at any time.</p>
                         <br>
  </div>

  @include('includes.sidebar_profile_right')

</div>


<script type="text/javascript">
  $(document).ready(function(){

    $("#invitybyemail").click(function() {
      $('#invitebyemail').show();
      $('#existingcontactlistDiv').hide();
      $('#contactlistDiv').hide();
      $('#norecordDiv').hide();
    });    

    $("#selectall_existingcontacts").click(function() {
      $(this).find("input[type=checkbox]").toggle("checked");
      if($(this).find("input[type=checkbox]").prop('checked')) {
        $(this).find("input[type=checkbox]").prop('checked', false);
        $(this).find("label.btn").removeClass("active");
        $("#existingcontactlist").find("label.btn").removeClass("active");
        $("#existingcontactlist").find("input[type=checkbox]").prop('checked', false);
      }else {
        $(this).find("input[type=checkbox]").prop('checked', true);
        $(this).find("label.btn").addClass("active");
        $("#existingcontactlist").find("label.btn").addClass("active");
        $("#existingcontactlist").find("input[type=checkbox]").prop('checked', true);
      }
    });

    $("#selectall_contactlist").click(function() {
      $(this).find("input[type=checkbox]").toggle("checked");
      if($(this).find("input[type=checkbox]").prop('checked')) {
        $(this).find("input[type=checkbox]").prop('checked', false);
        $(this).find("label.btn").removeClass("active");
        $("#contactlist").find("label.btn").removeClass("active");
        $("#contactlist").find("input[type=checkbox]").prop('checked', false);
      }else {
        $(this).find("input[type=checkbox]").prop('checked', true);
        $(this).find("label.btn").addClass("active");
        $("#contactlist").find("label.btn").addClass("active");
        $("#contactlist").find("input[type=checkbox]").prop('checked', true);
      }
    });

    $("#existingcontactlist").find("label.btn").click(function() {
        $(this).find("input[type=checkbox]").toggle("checked");
    });

    $("#contactlist").find("label.btn").click(function() {
        $(this).find("input[type=checkbox]").toggle("checked");
    });

    $("#frminvitation_email").submit(function(e) {
      e.preventDefault();
      if($("#inviteemail").val().trim() == "") {
        showSystemMessages('#systemMessage_network', 'danger', 'Please provide emails to send invitation.');
        return;
      }
      $.ajax({
          url: '/network/sendemailinvitation',
          type:'POST',
          dataType: 'json',
          data: $("#frminvitation_email").serialize(),
          beforeSend: function () {
            $('#sendinviteemail').prop('disabled', true);
            // $('#invitefrnd').prop('disabled', true);
            $(".container").css('opacity', '0.5');
            showSystemMessages('#systemMessage_network', 'info', 'Please wait while we process your request');
          },
          complete: function () {
            $('#sendinviteemail').prop('disabled', false);
            // $('#invitefrnd').prop('disabled', false);
            $(".container").css('opacity', '1');
          },
          success: function (response) {
            showSystemMessages('#systemMessage_network', response.type, response.msg);
          }
        });
    });

    $("#frminvitation").submit(function(e){
        e.preventDefault();
        $.ajax({
          url: '/network/sendinvitation',
          type:'POST',
          dataType: 'json',
          data: $("#frminvitation").serialize(),
          beforeSend: function () {
            $('#senfrndreq').prop('disabled', true);
            $('#invitefrnd').prop('disabled', true);
            $(".container").css('opacity', '0.5');
            showSystemMessages('#systemMessage_network', 'info', 'Please wait while we process your request');
          },
          complete: function () {
            $('#senfrndreq').prop('disabled', false);
            $('#invitefrnd').prop('disabled', false);
            $(".container").css('opacity', '1');
          },
          success: function (response) {
            showSystemMessages('#systemMessage_network', response.type, response.msg);
            if(response.type == "success"){
              $.each(response.data,function(key,contactid){
                $("#frminvitation").find("input[type=checkbox]").each(function() {
                  if($(this).val() == contactid) {
                    $(this).closest('div .form-control').find(".checkmark").show();
                    $(this).closest('div .form-control').find("label.btn").remove();
                    $(this).remove();
                  }
                });
              });
              if($("#frminvitation").find("input[type=checkbox]").length == 1) {
                $("#selectall_contactlist").closest("div .form-control").find(".checkmark").show();
                $("#selectall_contactlist").remove();
              }
            }
          }
        });
    });
   
    $("#frmfrndreq").submit(function(e){
        e.preventDefault();
        $.ajax({
          url: '/network/sendfriendrequest',
          type:'POST',
          dataType: 'json',
          data: $("#frmfrndreq").serialize(),
          beforeSend: function () {
            $('#senfrndreq').prop('disabled', true);
            $('#invitefrnd').prop('disabled', true);
            $(".container").css('opacity', '0.5');
          },
          complete: function () {
            $('#senfrndreq').prop('disabled', false);
            $('#invitefrnd').prop('disabled', false);
            $(".container").css('opacity', '1');
          },
          success: function (response) {  
            showSystemMessages('#systemMessage_network', response.type, response.msg);
            if(response.type == "success"){
              $.each(response.data,function(key,contactid){
                $("#existingcontact_"+contactid).find("label.btn").remove();
                $("#existingcontact_"+contactid).find(".checkmark").show();
                $("#existingcontact_"+contactid).find("input[type=checkbox]").remove();
              });
              if($("#frmfrndreq").find("input[type=checkbox]").length == 1) {
                $("#selectall_existingcontacts").closest("div .form-control").find(".checkmark").show();
                $("#selectall_existingcontacts").remove();
              }
            }
          }
        });
    });

  });

  function getContacts() {
    // e.preventDefault();
     $.ajax({
          url: '/network/getcontacts',
          type:'POST',
          dataType: 'json',
          data: $("#frmgetcontacts").serialize(),
          beforeSend: function () {
            // $('#login_submit').prop('disabled', true);
          },
          complete: function () {
            // $('#login_submit').prop('disabled', false);
          },
          success: function (response) {
          }
        });
  }
</script>

@endsection
