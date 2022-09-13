// business_profile.js

var busProfCurrentStep = 1;
var completedSteps = 1;
var socialProfilePopup;
var action = 'create';

$(function(){
  if($('#profileStepsWrap').length) {
    
    setupBusProfSteps();
    initBusProfValidations();
    addNewEducationRow();
    
    $('#profileStepsWrap .sgn').click(getSocialProfile);
    $('#profileStepsWrap .sgnup-rates .sgnup-rates').click(updateExpLevel);
    $('#profileStepsWrap #btnAddNewEdu').click(addNewEducationRow);
    $('#profileStepsWrap').on('click','.btnSaveEdu',saveEducation);
    $('#profileStepsWrap').on('click','.btnEditEdu',editEducation);
    $('#profileStepsWrap').on('click','.btnDelEdu',deleteEducation);
    $('#profileStepsWrap button.button-nxt').click(function(){
      $('#frmBusinessProfile').submit();
    });
    
    // Ajax profile photo uploader
    new ss.SimpleUpload({
      button: 'btn_upload_photo', // file upload button
      url: baseurl+'businessprofile/uploadProfilePhoto', // server side handler
      name: 'profile_photo', // upload parameter name
      responseType: 'json',
      allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
      maxSize: 2048, // kilobytes         
      onComplete: function(filename, response) {
          if (!response) {
              alert('Profile photo upload failed. Please try again');
              return false;            
          }
          $('#profileStepsWrap #upload_photo_name').val(response.file);
      }
    }); 
  }
});

function setupBusProfSteps() {
  busProfCurrentStep = 1;
  completedSteps = 1;
  changeBusProfileStep();
  
  $('#profileStepsWrap .profileSteps .steps>span').click(function(){
    var next_step = parseInt($(this).data('step'));
    if(action=='create' && next_step>completedSteps) return;
    busProfCurrentStep = next_step;
    changeBusProfileStep();
  });
}

function initBusProfValidations() {
  $('#frmBusinessProfile').validate({
    ignore: '.hidden input, .hidden select',
    rules: {
      name: {
        required: true
      },
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      },
      confirm_password : {
        required: true,
        equalTo: "#password"
      },
      'security_que[]': {
        required: true
      },
      'security_ans[]': {
        required: true
      }
    },
    messages: {
      name: {
        required: "Please enter name"
      },
      email: {
        required: "Please enter email address",
        email: "Please enter valid email address"
      },
      password: {
        required: "Please enter password",
        minlength: "Minimum 6 characters required"
      },
      confirm_password : {
        required: "Please enter confirm password",
        equalTo: "Password does not match"
      },
      'security_que[]': {
        required: 'Please enter question'
      },
      'security_ans[]': {
        required: 'Please enter answer'
      }
    },
    submitHandler: saveBusProf
  });
}

function changeBusProfileStep() {
  $('#profileStepsWrap [id^=btnStep]').removeClass('step-active');
  $('#profileStepsWrap [id^=wrapStep]').addClass('hidden');
  
  for(i=1; i<=busProfCurrentStep; i++){
    $('#profileStepsWrap #btnStep'+i).addClass('step-active');
  }
  $('#profileStepsWrap #wrapStep'+busProfCurrentStep).removeClass('hidden');
  if(completedSteps<busProfCurrentStep) completedSteps=busProfCurrentStep;
}

function getSocialProfile() {
  var provider = $(this).data('provider');
  if(provider==null || provider.trim() == '') return;
  socialProfilePopup = window.open(baseurl + 'businessprofile/getSocialProfile/' + provider, 'Social Profile Popup', "width=500,height=500");
  return false;
}

function updateUserProfileInfo(response){
  
  if(response.type=='success')
  {
    var profile = response.profile;
    if(profile) {
      var email = (profile.email!=null && profile.email!='')? profile.email : '';

      var name = '';
      if(profile.firstName!=null && profile.firstName!='')
      {
        name = profile.firstName;
        name += (profile.lastName!=null && profile.lastName!='')? ' ' + profile.lastName : '';
      }
      else if(profile.displayName!=null && profile.displayName!='')
      {
        name = profile.displayName;
      }

      var address = [];
      if(profile.address!=null && profile.address!='')
      {
        address.push(profile.address);
      }
      if(profile.city!=null && profile.city!='')
      {
        address.push(profile.city);
      }
      if(profile.country!=null && profile.country!='')
      {
        address.push(profile.country);
      }
      
      if(profile.photoURL!=null && profile.photoURL!='')
      {
        $('#myProfileBlock .user-img').html("<img src='"+profile.photoURL+"'>");
        $('#frmBusinessProfile #social_photo_url').val(profile.photoURL);
      }
      
      $('#frmBusinessProfile #email, #frmBusinessProfile #accountEmail').val(email);
      $('#frmBusinessProfile #name').val(name);
      $('#frmBusinessProfile #address').val(address.join(', '));

      $('#socialButtonsBlock').addClass('hidden');
      $('#myProfileBlock').removeClass('hidden');
    }
  }
  else {
    showSystemMessages('#systemMessage', response.type, response.msg);
  }
}

function updateExpLevel() {
  var level = parseInt($(this).data('level'));
  if(!isNaN(level)) {
    $('#profileStepsWrap .sgnup-rates .sgnup-rates.active').removeClass('active');
    $(this).addClass('active');
    $('#frmBusinessProfile #experience_level').val(level);
  }
}

function addNewEducationRow() {
  var temp_row = $('#eduRowTpl tr').clone();
  $('#tblEducation tbody').append(temp_row);
  if($('#tblEducation tbody>tr:not(.noinfo)').length>0) {
    $('#tblEducation tbody>tr.noinfo').addClass('hidden');
  }
}

function saveEducation() {
  var current_tr = $(this).parents('tr:first');
  var error = false;
  $(current_tr).find('td').each(function(index, cell){
    if($(cell).find('input, select').length==0) return;
    if($.trim($(cell).find('input, select').val())=='') {
      error = true;
      $(cell).find('input, select').addClass('error');
    }
    else {
      $(cell).find('input, select').removeClass('error');
    }
    $(cell).find('span').html($(cell).find('input, select').val());
  });
  
  if(error) return;
  
  $(current_tr).find('td>span, .btnEditEdu').removeClass('hidden');
  $(current_tr).find('td>input, td>select, .btnSaveEdu').addClass('hidden');
}

function editEducation() {
  var current_tr = $(this).parents('tr:first');
  $(current_tr).find('td>span, .btnEditEdu').addClass('hidden');
  $(current_tr).find('td>input, td>select, .btnSaveEdu').removeClass('hidden');
}

function deleteEducation() {
  if($(this).parents('tbody:first').find('tr:not(.hidden)').length==1) {
    $(this).parents('tbody:first').find('tr.noinfo').removeClass('hidden');
  }
  
  $(this).parents('tr:first').remove();
}

function saveBusProf() {
  if($('#frmBusinessProfile').valid()) {
    if(busProfCurrentStep<3)
    {
      busProfCurrentStep++;
      changeBusProfileStep();
    }
    else
    {
      console.log($('#frmBusinessProfile').serialize());
    }
  }
  return false;
}