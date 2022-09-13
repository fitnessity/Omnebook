var social_login_popup;

$(document).ready(function ()

{

  

});






function LoginUser()

{

  if ($('#frmlogin').valid())

  {

    $.ajax({

      type: 'post',

      url: baseurl + "auth/login",

      data: $('#frmlogin').serialize(),

      dataType: 'json',

      beforeSend: function () {

        $('#login_submit').prop('disabled', true);

      },

      complete: function () {

        $('#login_submit').prop('disabled', false);

      },

      success: function (response) {

               
        if (response.type == 'danger')

        {

          if (typeof (response.captcha_html) != undefined)

          {

            $('#capchaimg').html(response.captcha_html);

          }

        }

        else if (response.type == 'success')

        {

          window.location = response.redirecturl;

        }



        if (typeof (response.msg) != undefined)

        {

          showSystemMessages('#systemMessage', response.type, response.msg);

        }

      }

    });

  }

}



function registerUsingSocial(provider)

{

  social_login_popup = window.open(baseurl + 'auth/social_login/' + provider, 'socialloginpopup', "width=500,height=500");

}



function loginRedirection() 

{

  

}



// function openRegisterModal() 

// {

//   if($('.modal').length) 

//   {

//     $('.modal').modal('hide');

//   }

//   if ($('#btn_register').length > 0)

//   {

//     setTimeout(function(){$('#btn_register').trigger('click');}, 1000);

//   }

// }



