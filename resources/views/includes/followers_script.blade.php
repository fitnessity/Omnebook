<script>
      $(document).ready( function (){
        $('.follow').click( function(){
          
          var user_id = "<?php echo Auth::User()->id; ?>";
          var follow_id = this.id;
          var $this = $(this);

          if(user_id && user_id !== "" && user_id !== undefined && user_id !== null){
            $.ajax({
              url : '/network/user/follow',
              type : 'POST',
              dataType: 'json',
              data : {
                'users' : { id : user_id, follow_id : follow_id },
                '_token' : "<?php echo csrf_token(); ?>"
              },
              success : function(response){

                if(response.type === 'success'){
                  $('.follow').html(response.title);
                }

                if(response.type === 'success'){
                  $('#follow-msg').addClass('alert-success');
                  $('#follow-msg').css('display','block').html(response.msg);
                  $('#systemMessage_network').html(response.msg);
                }

                if(response.type === 'danger'){
                  $('#follow-msg').addClass('alert-danger');
                  $('#follow-msg').css('display','block').html(response.msg);
                  $('#systemMessage_network').html(response.msg);
                }

                setTimeout(function(){
                  $('#follow-msg').removeClass('alert-success');
                  $('#follow-msg').removeClass('alert-danger');
                  $('#follow-msg').css('display','none');
                }, 2000);
                // showSystemMessages('#systemMessage', response.type, response.msg);
              }
            });
          }
        });

        $('.un-follow').click( function(){
            var user_id = "<?php echo Auth::User()->id; ?>";
            var follow_id = this.id;
            var $this = $(this);

            if(user_id && user_id !== "" && user_id !== undefined && user_id !== null){
            $.ajax({
              url : '/network/user/follow',
              type : 'POST',
              dataType: 'json',
              data : {
                'users' : { id : user_id, follow_id : follow_id },
                '_token' : "<?php echo csrf_token(); ?>"
              },
              success : function(response){
                if(response.msg == 'Unfollowed successfully'){
                  $('#invitation_'+follow_id).remove();
                  if( $('ul.network-list li').length <= 0 ){
                    $('.network-list').html('<p>No records found</p>');
                  }
                }

                if(response.type === 'success'){
                  $('#follow-msg').addClass('alert-success');
                  $('#follow-msg').css('display','block').html(response.msg);
                }

                if(response.type === 'danger'){
                  $('#follow-msg').addClass('alert-danger');
                  $('#follow-msg').css('display','block').html(response.msg);
                }

                setTimeout(function(){
                  $('#follow-msg').removeClass('alert-success');
                  $('#follow-msg').removeClass('alert-danger');
                  $('#follow-msg').css('display','none');
                }, 2000);
              }
            });
          }
        });
      });
    </script>