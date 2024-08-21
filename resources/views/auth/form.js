$('#p_v_1').click(function(){
    $(".error").empty();
    if($("#p_firstname").val()!=''){
        if($("#p_lastname").val()!=''){
                if($("#p_email").val()!=''){
                    if($("#p_contact").val()!=''){
                            if($("#p_password").val()!=''){
                                if($("#p_confirm_password").val()==$("#p_password").val()){
                                    $('#fitnessity_professional').hide();$('#signup_selection').hide();$('#fitnessity_professional_step2').show();
                                }else{
                                    $("#p_cpass").text("Not match confirm password");       
                                }
                            }else{
                                $("#p_pass").text("Please Fill this");   
                            }
                    }else{
                        $("#p_cot").text("Please Fill this");
                    }
                }else{
                    $("#p_eml").text("Please Fill this");
                }
            }else{
    $("#p_ln").text("Please Fill this");
            }
    
    }else{
    $("#p_fn").text("Please Fill this");
    }
    });

   /* two */
   

   $('#p_v_2').click(function(){
    $(".error").empty();
    if($("#p_companyname").val()!=''){
        if($("#p_address").val()!=''){
                if($("#p_state").val()!=''){
                    if($("#p_city").val()!=''){
                        if($("#p_zipcode").val()!=''){
                            if($("#p_country").val()!=''){
                                $('#fitnessity_professional_step2').hide();$('#signup_selection').hide();$('#fitnessity_professional_step3').show();
                            }else{
                                $("#p_cont").text("Please Fill this");
                            }
                        }else{
                            $("#p_zip").text("Please Fill this");
                        }
                    }else{
                        $("#p_ct").text("Please Fill this");
                    }
                }else{
                    $("#p_sta").text("Please Fill this");
                }
            }else{
    $("#p_addr").text("Please Fill this");
            }
    
    }else{
    $("#p_cmpo").text("Please Fill this");
    }
    });

    /* three 
    
    */
   $("#p_submit").click(function(){
    $(".error").empty();
    if($("#p_EINnumber").val()!=''){
        if($("#p_SSNnumber").val()!=''){
        if($('#p_Establishmentyear').val()!=""){
            if($('#p_trm').prop("checked") == true){
                $('#fitnessity_professional_step2').hide();$('#signup_selection').hide();$('#fitnessity_professional_step3').hide();
                   alert("From submit");
            }else{
                alert("Please Accept Terms of Service");
            }
        }else{
            
            $("#p_estb").text("Please Fill this");
        }
        }else{
            $("#p_ssn").text("Please Fill this");
        }
    }else{
        $("#p_ein").text("Please Fill this");
    }

   });