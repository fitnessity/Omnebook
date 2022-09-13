<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<div id="error-message"></div>
<div class="row">
<div class="col-md-6">
<form id="frmStripePayment" action="" method="post">
    <div class="field-row">
        <label>Card Holder Name</label> <span id="card-holder-name-info"
            class="info"></span><br> <input type="text" id="name"
            name="name" class="demoInputBox">
    </div>
    <div class="field-row">
        <label>Email</label> <span id="email-info" class="info"></span><br>
        <input type="text" id="email" name="email" class="demoInputBox">
    </div>
    <div class="field-row">
        <label>Card Number</label> <span id="card-number-info"
            class="info"></span><br> <input type="text" id="card-number"
            name="card-number" class="demoInputBox">
    </div>
    <div class="field-row">
        <div class="contact-row column-right">
            <label>Expiry Month / Year</label> <span id="userEmail-info"
                class="info"></span><br> 
                <select name="month" id="month"class="demoSelectBox">
                <?php
                for($i=1;$i<=12;$i++){
                    if(strlen($i)==1){
                        echo ' <option value="0'.$i.'">0'.$i.'</option>';
                    }else{
                        echo ' <option value="'.$i.'">'.$i.'</option>';
                    }
                }
                ?>
                
            </select> <select name="year" id="year"
                class="demoSelectBox">
                <?php 
                for($i=0;$i<=9;$i++){
                        echo ' <option value="202'.$i.'">202'.$i.'</option>';
                }
                ?>
            </select>
        </div>
        <div class="contact-row cvv-box">
            <label>CVC</label> <span id="cvv-info" class="info"></span><br>
            <input type="text" name="cvc" id="cvc"
                class="demoInputBox cvv-input">
        </div>
        
        
       
        
    </div>
     <div class="contact-row cvv-box term-wrapprbox">
         {{$name}} requires you to agree to the terms to participate in this activity. <br>
            <label><input type="checkbox" value="1" id="termc"> Please Accept the <a href="#" data-toggle="modal" data-target="#TermsModal">terms and condition </a></label>
            
        </div>
    <div>
        <input type="submit" name="pay_now" value="Submit"
            id="submit-btn" class="btnAction"
            onClick="stripePay(event);">

        
    </div>
   <input type="hidden" name="token" id="sttoken" value="">
   
</form>
</div>
<div class="col-md-6" style="padding-top: 30vh;">

        <div id="TermsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                {{$terms_conditions}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
        

<div id="loader">
            <img alt="loader" src="https://thumbs.gfycat.com/MarriedMarvelousHawaiianmonkseal-small.gif">
            Your payment is under Processing please wait... 
        </div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
function cardValidation () {
    var valid = true;
    var name = $('#name').val();
    var email = $('#email').val();
    var cardNumber = $('#card-number').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var cvc = $('#cvc').val();
    var term = $("input[type='checkbox']#termc:checked").val();
    $("#error-message").html("").hide();

    if (name.trim() == "") {
        valid = false;
    }
    if (email.trim() == "") {
    	   valid = false;
    }
    if (cardNumber.trim() == "") {
    	   valid = false;
    }

    if (month.trim() == "") {
    	    valid = false;
    }
    if (year.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }
if (term != 1) {
        valid = false;
    }
    if(valid == false) {
        $("#error-message").html("All Fields are required").show();
    }

    return valid;
}
//set your publishable key
Stripe.setPublishableKey("<?php echo env('STRIPE_PKEY'); ?>");

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        //enable the submit button
        $("#submit-btn").show();
        $( "#loader" ).css("display", "none");
        //display the errors on the form
        $("#error-message").html(response.error.message).show();
    } else {
        //get token id
        var token = response['id'];
         console.log(response['id']);
        //insert the token into the form
        $("#sttoken").val(token);
        
        $(".paymentmsg").text("Click Next to Proceed").show();
        $('.payment').hide();
        gopaymnet();
        //submit form to the server
        //$("#frmStripePayment").submit();
    }
}
function stripePay(e) {
    e.preventDefault();
    var valid = cardValidation();

    if(valid == true) {
        $("#submit-btn").hide();
        $( "#loader" ).css("display", "inline-block");
        Stripe.createToken({
            number: $('#card-number').val(),
            cvc: $('#cvc').val(),
            exp_month: $('#month').val(),
            exp_year: $('#year').val()
        }, stripeResponseHandler);

        //submit from callback
        return false;
    }
}
function gopaymnet(){
var token = $('#sttoken').val();
 $.ajax({
          url:'/payment/'+token,
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
            if(response.status==1){
                $('#bsuname').text(response.name);
               $('#formstep5').hide();$('#formstep6').show();
            }else{
              $('.payment').html(response.msg2);
            }
            }
        });
}
</script>
<style>


#frmStripePayment {
    max-width: 400px;
    padding: 25px;
    border: #D0D0D0 1px solid;
    border-radius: 4px;
}

.test-data {
    margin-top: 40px;
}

.tutorial-table {
    border: #D0D0D0 1px solid;
    font-size: 0.8em;
    color: #4e4e4e;
}

.tutorial-table th {
    background: #efefef;
    padding: 12px;
    border-bottom: #e0e0e0 1px solid;
    text-align: left;
}

.tutorial-table td {
    padding: 12px;
    border-bottom: #D0D0D0 1px solid;
}

#frmStripePayment .field-row {
    margin-bottom: 20px;
}

#frmStripePayment div label {
    margin: 5px 0px 0px 5px;
    color: #49615d;
    width: auto;
}

.demoInputBox {
    padding: 10px;
    border: #d0d0d0 1px solid;
    border-radius: 4px;
    background-color: #FFF;
    width: 100%;
    margin-top: 5px;
    box-sizing:border-box;
}

.demoSelectBox {
    padding: 10px;
    border: #d0d0d0 1px solid;
    border-radius: 4px;
    background-color: #FFF;
    margin-top: 5px;
}

select.demoSelectBox {
    height: 45px;
    margin-right: 0px;
}

.error {
    background-color: #FF6600;
    padding: 8px 10px;
    border-radius: 4px;
    font-size: 0.9em;
}

.success {
    background-color: #c3c791;
    padding: 8px 10px;
    border-radius: 4px;
    font-size: 0.9em;
}

.info {
    font-size: .8em;
    color: #FF6600;
    letter-spacing: 2px;
    padding-left: 5px;
}

.btnAction {
    background-color: #586ada;
    padding: 10px 40px;
    color: #FFF;
    border: #5263cc 1px solid;
    border-radius: 4px;
    cursor:pointer;
}

.btnAction:focus {
    outline: none;
}

.column-right {
    margin-right: 6px;
}

.contact-row {
    display: inline-block;
}

.cvv-input {
    width: 60px;
}

#error-message {
    margin: 0px 0px 10px 0px;
    padding: 5px 25px;
    border-radius: 4px;
    line-height: 25px;
    font-size: 0.9em;
    color: #ca3e3e;
    border: #ca3e3e 1px solid;
    display: none;
    width: 300px;
}

#success-message {
    margin: 0px 0px 10px 0px;
    padding: 5px 25px;
    border-radius: 4px;
    line-height: 25px;
    font-size: 0.9em;
    color: #3da55d;
    border: #43b567 1px solid;
    width: 300px;
}

.display-none {
    display:none;
}

#response-container {
    padding: 40px 20px;
    width: 270px;
    text-align:center;
}


.ack-message {
    font-size: 1.5em;
    margin-bottom: 20px;
}

#response-container.success {
    border-top: #b0dad3 2px solid;
    background: #e9fdfa;
}

#response-container.error {
    border-top: #c3b4b4 2px solid;
    background: #f5e3e3;
}

.img-response {
    margin-bottom: 30px;
}

#loader {
    display: none;
}

#loader img {
    width: 45px;
    vertical-align: middle;
}
</style>