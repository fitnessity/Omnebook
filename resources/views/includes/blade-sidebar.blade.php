<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>feedpost/jquery.lightbox-0.5.css" rel="stylesheet">

<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>lightbox2.min.css" rel="stylesheet">

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox-plus-jquery.min.js"></script>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox.js"></script>

<style>
  .verification a {
    display: inline-block;
    height: 40px;
    padding: 6px;
    width: 40px !important;
    border-radius: 50%;
    border: 1px solid #fff;
    vertical-align: middle;
    margin-left: 4px !important;
}
.verification{
    border-bottom: 45px solid #eee;
    margin-bottom: 50px;
}
a#mycompanyimage{
        color: #fff;
    font-size: 21px;
    text-transform: uppercase;
    font-weight: bold;
    font-family: 'OswaldLight';
    text-decoration-line: underline;
}
</style>

  <div class="business-left">



    <div class="business-left-pic nw-user-img">



      <?php if(Auth::user()){

        $userFavoriteImages = App\TimelineMedia::getUserFavoriteMedia(Auth::user()->id);

      } ?>

      
      
      <?php

      $loggedinUser = Auth::user();

      

      ?>

      
    </div>




    <div class="verification" style="border-bottom: 0px;margin-bottom: 0px;">



      <h2>VERIFICATION</h2>



      <div class="veri-icon">


     <span >@if(isset($company->phone))
      <a href="#" style="background-color:transparent" title="phone" class="cophone"><i class="fa fa-phone" aria-hidden="true"></i></a>
     @else 
     <a href="#" class="cophone"><i class="fa fa-phone"  title="phone" aria-hidden="true"></i></a>
     @endif</span>


    <span >@if(isset( $company['users']['email']))
      <a href="#" style="background-color:transparent" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
     @else 
     <a href="#"  title="email" class="coemail"><i class="fa fa-envelope"  aria-hidden="true"></i></a>
     @endif</span>
       <span>
      <a href="#" style="background-color:transparent" title="link" class="coaddress" ><i class="fa fa-link" aria-hidden="true"></i></a>
    </span>
        <!--<a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>-->
         <span >@if(isset( $company->address))
      <a href="#" style="background-color:transparent" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
     @else 
     <a href="#" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
     @endif</span>
        
        
<!--<a href="javascript:void();"><i class="fa fa-check" aria-hidden="true"></i></a>-->
        <!--<a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a>-->



      </div>
         
       
    
    
<div class="text-left" style="width: 100%;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-top:30px;color:#000;background-color:#fff;">
      <ul class="list-group list-group-flush">
        <li class="list-group-item"> <i class="fa fa-map-o"></i> STATISTIC</li>
      </ul>
      <div class="row" style="background-color:#fff">
          <div class="col-sm-6">
              <div style="height: 28px;width: 28px;border-radius: 14px;background-color:#f2f1f5;" class="text-center">
                  <i class="fa fa-map-o" style="color:#9b9ca4;margin-top: 7px;"></i>
              </div>
              <span style="color:#a4a5ab"> 42334 Views</span>
          </div>
          <div class="col-sm-6">
              <div style="height: 28px;width: 28px;border-radius: 14px;background-color:#f2f1f5;" class="text-center">
                  <i class="fa fa-star-o" style="color:#9b9ca4;margin-top: 7px;"></i>
              </div>
              <span style="color:#a4a5ab"> 8 Ratings</span>
          </div>
      </div>
      
   </div>
    </div>
    <div class="row" style="background-color:#fff">
          <div class="col-sm-6">
              <div style="height: 28px;width: 28px;border-radius: 14px;background-color:#f2f1f5;" class="text-center">
                  <i class="fa fa-heart-o" style="color:#9b9ca4;margin-top: 7px;"></i>
              </div>
              <span style="color:#a4a5ab"> 36 Favourites</span>
          </div>
          <div class="col-sm-6">
              <div style="height: 28px;width: 28px;border-radius: 14px;background-color:#f2f1f5;" class="text-center">
                  <i class="fa fa-repeat" style="color:#9b9ca4;margin-top: 7px;"></i>
              </div>
              <span style="color:#a4a5ab"> 28 Shares</span>
          </div>
      </div>
     <div class="favorites">

    </div>
    
  </div>

<script type="text/javascript">
    var curl = window.location.href
    if(curl.includes('/pcompany/view/')){
       $('#mycompanyimage').show()
    }
    
    $('#mycompanyimage').click(function() {
   $('#Modal').modal('show');
});


    $('.delimg').click(function(){
       $.ajax({
          url:"{{url('/delete-image-company?myindex=')}}"+$(this).attr('myindex')+'&company_id='+$(this).attr('company_id'),
          type:'get',
           beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) { 
              //if(response.status ==200){
                window.location.reload()
                  $(this).parent().remove();
              //}
          }
         })
      
    })


    var form = document.querySelector('form');



    // edit profile picture

    $('#frmeditProfile_side').submit(function(e) {

      e.preventDefault();

      $('#frmeditProfile_side').validate({

          rules: {

              profile_pic: {

               required: true,

               accept: "image/*"   

              },

          },

          messages: {

              profile_pic: {

                  required: "Upload a Profile picture",

                  accept: "Please upload an image"

              },

          }

      });

      if(!$('#frmeditProfile_side').valid()) {

          return false;

      }

      var inputData = new FormData($(this)[0]);

      $.ajax({

        url:'/profile/editProfilePicture',

        type:'POST',

        dataType: 'json',

        data:inputData,

        processData:false,

        contentType:false,

        beforeSend: function () {

          $('#submit_profilepic').prop('disabled', true);

        },

        complete: function () {

          $('#submit_profilepic').prop('disabled', false);

        },

        success: function (response) {                      

              if (response.type == 'success') {
                     showSystemMessages('#systemMessage', 'success', 'Profile picture updated scuccessfully');
                  // $("#display_user_profile_pic").attr("src", response.returndata.profile_pic);

                  $(".display_user_profile_pic_view_profile").each(function(){

                    $(this).attr("src", response.returndata.profile_pic);

                  });

                  $('#editProfilePic').modal('hide');

              }else {

                  showSystemMessages('#systemMessage', response.type, response.msg);

              }

          }

      });

    });



</script>