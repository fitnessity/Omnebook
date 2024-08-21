    <script src="{{url('/public/ratings.js')}}"></script>

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-body login-pad">      

      <!-- signup_normal div starts --> 

      <!-- <div id="signup_normal"> -->

        <div class="pop-title employe-title">
        	<h3>FITNESSITY FEEDBACK</h3>
        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">
        	<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
        </button>			

        <div class="signup">
          <div id='systemMessage'></div>
          <div class="emplouyee-form">    
            <div class="write-review-form">
              <div class="review-form-block rvw-ex-mrgn">
                <div class=" form-review-slct form-review-slct1 ">
                </div>
              </div>

              <form  id="frmfeedback" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="rvw-overall">                  
                  <input type="hidden" name="rating" id="rating" value="">
                  <div class="rvw-overall-rate rvw-ex-mrgn">
                    <span>ratings</span>
                    <div id="stars" class="starrr"></div>
                  </div>                  
                  <textarea name="comment" id="comment" placeholder="Say something About Fitnessity"></textarea>             
                  <textarea name="suggestion" id="suggestion" placeholder="Any suggestions for us ?"></textarea>
                  @if (Auth::guest())
                    <input type="text" name="name" id="name" size="255" maxlength="255" placeholder="Name">
                    <input type="email" name="email" id="email" size="255" placeholder="Email Address" maxlength="255">
                  @else
                  <?php $loggedinUser = Auth::user(); ?>
                    <input type="text" name="name" id="name" size="255" maxlength="255" placeholder="name" value="{{ $loggedinUser['firstname'] }} {{ $loggedinUser['lastname'] }}" readonly>
                    <input type="email" name="email" id="email" size="255" placeholder="Email Address" maxlength="255" value="{{ $loggedinUser['email'] }}" readonly>
                  @endif 
                </div>

                 <div class="by-sign">
                  <button class="btn btn-primary" id='feedback_submit' onclick="$('#frmfeedback').submit();" style="padding: 6px 12px !important;text-transform: uppercase;border-radius: 50px;right: 0 !important;width: 35%;margin-top:5%">SUBMIT FEEDBACK</button>
                  <p></p>
                </div>
              </form>

           </div>
           </div>
        </div>

      <!-- </div> -->

      <!-- signup_normal div ends --> 

      </div>
    
    </div>

<script>
$(document).on("ajaxComplete", function(){
  
    $("#frmfeedback").submit(function(e){

        e.preventDefault();

          // check for validation
          $('#frmfeedback').validate({
              rules: {
                  // rating: "required",
                  comment: "required",
                  name: "required",
                  email: "required"
              },
              messages: {
                  // rating: "Provide ratings",
                  comment: "Provide Comments",
                  name: "Enter your Name",
                  email: "Enter your Email",                  
              },
              submitHandler: saveFeedback
        });
  });

});
    
function saveFeedback() {

        if($("#rating").val() == 0 || $("#rating").val() == "") {
          showSystemMessages('#systemMessage', 'danger', 'Please provide some ratings');
          return false;
        }
        var validForm = $('#frmfeedback').valid();
        var posturl = '/feedback/saveFeedback';

        if (validForm) {

          var formData = $("#frmfeedback").serialize();

          $.ajax({
              url:posturl,
              type:'POST',
              dataType: 'json',
              data:formData,
              beforeSend: function () {
                $('#feedback_submit').prop('disabled', true);
                showSystemMessages('#systemMessage', 'info', 'Please wait while we save your feedback.');
              },
              complete: function () {
                $('#feedback_submit').prop('disabled', false);
              },
              success: function (response) {                     
                    showSystemMessages('#systemMessage', response.type, response.msg);
                    setTimeout( function(){
						location.reload();
                    }, 1000);
                }
            });
        }
}
</script>