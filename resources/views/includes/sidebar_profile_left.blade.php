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

      
      <div class="prfl-pctr">

      <?php

      $loggedinUser = Auth::user();

      if($loggedinUser['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$loggedinUser['profile_pic'])) {

        echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$loggedinUser['profile_pic'].'" width="352" height="314" id="display_user_profile_pic"  class="display_user_profile_pic_view_profile" />';

      }

      else {

        echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="352" height="314" id="display_user_profile_pic"   class="display_user_profile_pic_view_profile"/>';

      }

      ?>

      @can('profile_edit_access')

                <!--<a href="javascript:void(0);" class="edit-pic" data-toggle="modal" data-target="#editProfilePic" title="Click here to change picture"><i class="fa fa-camera"></i></a>-->
      </div>
      @endcan
       <h2 class="cmpny-name"><?php echo $loggedinUser['company_name']?></h2>
         @if($loggedinUser['role'] != "business")
      <h2 class="prfl-nme"><span><?php echo $loggedinUser['firstname'];?></span> <span> <?php echo  $loggedinUser['lastname'];?> </span></h2>
      @endif
       <h2 class="username"> @<?php echo $loggedinUser['username'];?></h2>
    <!--<h2>About Me</h2>-->
      <p id="intro-user"><?php echo $loggedinUser['intro'];?></p>

    </div>



                <!-- Modal -->

                <div class="modal fade" id="editProfilePic" role="dialog">

                  

                  {!! Form::open(array('files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditProfile_side')) !!}



                  <input type="hidden" name="_token" value="{{ csrf_token() }}">



                  <div class="modal-dialog modal-lg">

                    <!-- Modal content-->

                    <div class="modal-content">

                      <div class="modal-body login-pad">

                        <div class="pop-title employe-title">

                          <h3>EDIT PROFILE PICTURE</h3>

                        </div>

                        <button type="button" class="close modal-close" data-dismiss="modal">

                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

                      </button>

                        <div class="signup">

                          <div id='systemMessage'></div>

                          <div class="emplouyee-form">

                            <input class="upload-pic" type="file" name="profile_pic" id="profile_pic" class="form-control">

                            <button type="submit" id="submit_profilepic">Submit</button>

                          </div>

                        </div>

                    </div>

                  </div>

                  

                </div>

                {!! Form::close() !!}

              </div>

              <!-- Modal Ends -->  

                

    <div class="verification">



      <h2>VERIFICATION</h2>



      <div class="veri-icon">


     <span >@if(isset( $loggedinUser['username']))
      <a href="#" style="background-color:green" title="phone" class="cophone"><i class="fa fa-phone" aria-hidden="true"></i></a>
     @else 
     <a href="#" class="cophone"><i class="fa fa-phone"  title="phone" aria-hidden="true"></i></a>
     @endif</span>


    <span >@if(isset( $loggedinUser['email']))
      <a href="#" style="background-color:green" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
     @else 
     <a href="#"  title="email" class="coemail"><i class="fa fa-envelope"  aria-hidden="true"></i></a>
     @endif</span>
      
        <!--<a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>-->
         <span >@if(isset( $loggedinUser['address']))
      <a href="#" style="background-color:green" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
     @else 
     <a href="#" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
     @endif</span>
        <span>
              @if($loggedinUser['role'] == "business")
<div class="veri-icon" style="margin-top:13px;display: contents;">
 <?php if(@$approve[0]['status']==1){ ?>
<a href="javascript:void();"  title="check" style="background-color:green"><i class="fa fa-check"  aria-hidden="true"></i></a>
            <?php }else{ ?>
<a  href="javascript:void();"><i class="fa fa-times" aria-hidden="true"></i> </a>
            <? } ?>
</div>
@endif</span>
        
<!--<a href="javascript:void();"><i class="fa fa-check" aria-hidden="true"></i></a>-->
        <!--<a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a>-->



      </div>
      
      

    </div>
    
    <div id="Modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:black;">Add Company Images</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/company-image-upload')}}" enctype="multipart/form-data">
            @isset($company->id)
            <input type="hidden" name="company_id" value="{{$company->id}}" />
            @endisset
            <input required type="file" class="form-control" name="images[]" placeholder="Company Image" multiple>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Save</button>
         </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
      </div>
    </div>

    <a href="#" id="mycompanyimage" style="display:none">Upload Company Image</a>
    
    
         @isset($company->company_images)
         <div class="row" style="padding: 10px 20px;">
            @foreach(json_decode($company->company_images) as $key=>$value)
            
                <div class="col-md-4" class="imgdeletediv" style="position:relative;padding: 15px;">
                    <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$value; ?>" style="width:100%;height:auto;" />
                    <button type="button" myindex="{{$key}}" company_id="{{$company->id}}" class="btn btn-primary delimg" style="margin-top: 15px;"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </div>
            @endforeach
            </div>
         @endisset
 

    <div class="favorites">

    {{--    <h2>My Favorites</h2>  --}}

      <ul class="verifi-list">



        @if(isset($userFavoriteImages) && count($userFavoriteImages) > 0 )



        @foreach($userFavoriteImages as $id => $images)



        <?php



         $galleryUploadPath = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-gallery' . DIRECTORY_SEPARATOR . Auth::user()->id.DIRECTORY_SEPARATOR;





          if(file_exists($galleryUploadPath.'thumb'.DIRECTORY_SEPARATOR.$images)){ ?>

             

            <li><a data-lightbox="example-set" data-title="<?php echo $images; ?>" class="" href="<?php echo Config::get('constants.POST_IMAGE').Auth::user()->id.'/thumb/'.$images; ?>"><img src="<?php echo Config::get('constants.POST_IMAGE').Auth::user()->id.'/thumb/'.$images; ?>" height="100" width="100" title="<?php echo $images; ?>" /></a>

            </li>

          <?php }



        ?>

        @endforeach

        @endif



      </ul>

    </div>




{{--  
    <div class="business-activites">

      <h2>ACTIVITIES</h2>

      <a href="#">- Solum indoctum reque dolorem</a>

      <a href="#">- Solum indoctum reque dolorem</a>

      <a href="#">- Solum indoctum reque dolorem</a>

      <a href="#">- Solum indoctum reque dolorem</a>

    </div>  --}}

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