<!-- professional detail modal -->
  <div class="modal fade" id="profiledetail_modal" role="dialog">
    <div class="modal-dialog modal-lg">
          <div  id="professionaldetail_modal_content"></div>
          <div class="modal-body login-pad">
              <div class="pop-title employe-title">
                  <h3>Profile</h3>
              </div>
              <button type="button" class="close modal-close" data-dismiss="modal">
                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
              </button>
              <div class="modal-content">                
              </div>
          </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready( function(){
      $('#profiledetail_modal').on('hidden.bs.modal', function () {
        // remove the bs.modal data attribute from it
        $(this).removeData('bs.modal');
        // and empty the modal-content element
        $('#profiledetail_modal .modal-content').empty();
      });
    });
  </script>