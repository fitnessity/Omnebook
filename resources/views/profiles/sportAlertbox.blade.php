    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>ratings.js"></script>

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-body login-pad">      

        <!-- signup_normal div starts --> 

        <!-- <div id="signup_normal"> -->

        <div class="pop-title employe-title">
        	<h3>FITNESSITY NOTIFICATION</h3>
        </div>

        <button type="button" class="close modal-close" data-dismiss="modal" >
        	<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/ id="sportalertpopup">
        </button>			

        <div class="signup">
              <p>We have added new courses for you. So please select specific course from your profile for which you provide services.
              Incase you don't update your profile, interested persons will not be able to find you on Fitnessity. So <a href="/profile/viewProfile">Update Your Profile</a> now!</p></span>
          <!-- </div> -->
          <!-- signup_normal div ends --> 
        </div>
    
      </div>

    </div>



    <script>
      $(document).ready(function(){
        $('#sportalertpopup').click(function() {
          location.reload();
        });
      });
    </script>