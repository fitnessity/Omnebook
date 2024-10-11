 <style>
 
  .step{
    background-color: #69af6a;
  }
  .form-group span {
    color: red;
    text-align: left !important;
}
  button#evident{
    float: right;
    width: auto;
    display: inline-block;
    font-size: 14px;
    margin: 40px 0 25px;
    background: #f53b49 none repeat scroll 0 0;
    border: 1px solid #f53b49;
    padding: 8px 35px;
    cursor: pointer;
    text-transform: uppercase;
    color: #fff;
  }
  div#recurring_pay {
    margin-left: 30px;
    margin-bottom: 30px;
}
.step2multiples{
  width: 50%;
}
  .stepbtn{
    width: auto;
    display: inline-block;
    font-size: 14px;
    margin: 40px 0 25px;
    background: #f53b49 none repeat scroll 0 0;
    border: 1px solid #f53b49;
    padding: 8px 35px;
    cursor: pointer;
    text-transform: uppercase;
    color: #fff;
  }
.hrsam {
    border-top: 1px solid #dedede;
    padding: 20px 0px 5px 0px;
    text-align: initial;
}
  #salestaxpercentage{
        position: relative;
    top: -21px;
    right: -80px;
  }
  div#duestaxpercentage {
    position: relative;
    top: -21px;
    right: -80px;
}
#multisession{
  position: relative;
    top: -30px;
    right: -120px;
}
.pop-title1 {
    background: #f53b49;
    text-align: right;
    width: 50%;
    padding: 10px 20px;
    height: 70px;
    margin: 30px 0 -60px;
    float: none;
    position: relative;
    left: -20px;
    top: -100px;
}
.pop-title2 {
    background: #f53b49;
    text-align: right;
    width: 50%;
    padding: 10px 20px;
    height: 70px;
    margin: 30px 0 -60px;
    float: none;
    position: relative;
    left: -20px;
    top: -100px;
}
.pop-title3 {
    background: #f53b49;
    text-align: right;
    width: 50%;
    padding: 10px 20px;
    height: 70px;
    margin: 10px 0 -60px;
    float: none;
    position: relative;
    left: -20px;
    top: -100px;
}
.pop-title1 h3 {
    color: #fff;
    font-size: 48px;
    font-family: 'bebasregular';
    line-height: 58px;
}
.pop-title2 h3 {
    color: #fff;
    font-size: 48px;
    font-family: 'bebasregular';
    line-height: 58px;
}
.pop-title3 h3 {
    color: #fff;
    font-size: 48px;
    font-family: 'bebasregular';
    line-height: 58px;
}
#errorevident{text-transform: inherit;
    color: #ff0909;
    }
    .loader2{
      position: relative;
      display: block !important;
      width: 50px;
      height: 50px;
      left: 48%;
      top: 40%;
      border-style: solid;
      border-color: #f53b49;
      border-top-color: transparent;
      border-width: 16px;
      border-radius: 50%;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
      z-index: 9999999;
    }
</style>
   <div class="modal-dialog modal-lg">
            <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-body login-pad">
                
                <button type="button" class="close modal-close" data-dismiss="modal">
                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
            <div class="signup">
                <div class="pop-title1 employe-title">
                  <h3>Fill the Details</h3>
                
                </div>
                  @if($check) <img src="/public/images/backgroundcheck.jfif">  @endif
                  @if($check) <h3><div class="loader2" ></div></h3>  @endif
                  @if($d!='') <h3>{{$d}}</h3>  @endif
                  <p id="errorevident"></p>
     @if($d=='') 
        <form method="post" enctype="multipart/form-data" id="myevident" ><div class="loader" id="loader" style="display: none;"></div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <span id="nameerror"></span>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your First Name"/>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <span id="lastnameerror"></span>
                    <input type="text" name="lastname" id="last" class="form-control" placeholder="Enter your last Name"/>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <span id="dateofbirtherror"></span>
                    <input type="date" name="dateofbirth" id="dateofbirth" class="form-control" placeholder="Enter your DOB"/>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group">
                    <span id="ssnerror"></span>
                    <input type="text" name="ssn" id="ssn" class="form-control" placeholder="Enter your SSN"/>
                    </div>
      </div>               
                </div>
              
                <button type="submit" id="evident">SUBMIT</button>
            </div>    
        </from>
          @endif   
            </div>
        </div>
    </div>        
</div>    
<script>
     $(document).ready(function() {
      $("#myevident").submit(function(e) {
        
          e.preventDefault();
          $('.form-group span').text('');
          var error = '';
          var returnVal;
          returnVal = true;
if($("#ssn").val()==''){
    $('#ssnerror').text("Please Enter SSN Number");
    returnVal =  false;
}
if($("#dateofbirth").val()==''){
    $('#dateofbirtherror').text("Please Enter DOB");
    returnVal =  false;
}
if($("#name").val()==''){
    $('#nameerror').text("Please Enter SSN Name");
    returnVal =  false;
}
if($("#last").val()==''){
    $('#lastnameerror').text("Please Enter Last Name");
    returnVal =  false;
}
//$('#errorevident').html(error);
if(returnVal==true){
          var inputData = $(this).serializeArray();
          $.ajax({
          url:'/evidentdata',
          type:'post',
          data:inputData,
          dataType: 'json',
          beforeSend: function () {
             $('#loader').show();
           },
           complete: function () {
             $('#loader').hide();
           },
          success: function (response) { 
            $('#errorevident').html("Request Submitted Wait for the approval");
            setTimeout(function(){ $('#addService').modal('hide'); }, 3000);
            }
        });
}
     });
});
</script>