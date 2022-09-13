@extends('layouts.header')
@section('content')
<section class="main-slider contact-banner">
    <div class="container">
        <h1>Newsletter</h1>
    </div>
</section>

<section class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ Config::get('constants.SITE_URL') }}">HOME</a></li><li><i class="fa fa-angle-right"></i></li>
            <li>Newsletter</li>
        </ul>
    </div>
</section>
        <div class="alert alert-success fade in alert-dismissible show successmsg" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button> {{ session()->get('success') }}
        </div> 
        <div class="alert alert-success fade in alert-dismissible show successmsg unsub" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
              
            </button> Unsubscribe Succesfully !
        </div>                                 
        
<div class="location-detail contactpage-sec">
    <div class="container">
        <div class="location-right">
            <h2>Unsubscribe</h2>
             <div id="systemMessage_comment"></div>
           <form method="post" id="submit_unsubscribe">

		      	<input type="email" placeholder="Enter E-mail Address" name="email" id="email" autocomplete="off" />

		      	<input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

                <div class="row col-md-12 form-group">
                    <button class="btn-u" id="unsubscribe_submit" type="submit">Unsubscribe</button>
                </div>
            </form>
        </div>

    </div>
</div>   

<script>
    $('#submit_unsubscribe').submit(function(e){
		e.preventDefault();
		$('#submit_unsubscribe').validate(
		{
			rules:{
				email:{required:true,email:true}				
			},
			messages:{
				email:{
					required:"Email is required",
					email:"Please enter a valid email address",
				}
			}
		});
		if(!$('#submit_unsubscribe').valid()){
			return false;
		}
		else
		{
			$.ajax(
			{
				type:"POST",
				url:'/unsubscribe',
				data:$('#submit_unsubscribe').serialize(),
				dataType:'json',
				beforeSend:function(){
					$('#unsubscribe_submit').prop('disabled',true);
				},
				complete:function(){
					$('#unsubscribe_submit').prop('disabled',false);
				},
				success:function(response){
					$('#submit_unsubscribe')[0].reset();
					$('.unsub').css("display",'block');
					showSystemMessages('#systemMessage_comment',response.type,response.msg);
				}
			});
		}
	});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".main-slider").remove();
       

        function SubmitContact() {
            var validForm = $('#frmcontact').valid();
            var posturl = '/contact-us';
            if (validForm) {
                var formData = $("#frmcontact").serialize();
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                  }
              });
                $.ajax({
                    url: posturl,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    beforeSend: function () {
                        $('#frmcontact_submit').prop('disabled', true);
                        showSystemMessages('#systemMessage', 'info', 'Please wait while we save your Enquiry.');
                    },
                    complete: function () {
                        $('#frmcontact_submit').prop('disabled', false);
                    },
                    success: function (response) {
                        if (typeof (response.msg) != undefined)
                        {
                            showSystemMessages('#systemMessage', response.type, response.msg);
                        }
                        if (response.type == "success") {
                            $("#name").val('');
                            $("#email").val('');
                            $("#message").val('');
                        }
                        location.reload();
                        $('.successmsg').css("display", "block");

                    }
                });
            }
        }
    });
</script>
@include('layouts.footer')
@endsection