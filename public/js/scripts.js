/*!
 * Start Bootstrap - Resume v6.0.2 (https://startbootstrap.com/theme/resume)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-resume/blob/master/LICENSE)
 */
(function ($) {
    "use strict"; // Start of use strict

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (
            location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length ?
                target :
                $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate({
                        scrollTop: target.offset().top,
                    },
                    1000,
                    "easeInOutExpo"
                );
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $(".js-scroll-trigger").click(function () {
        $(".navbar-collapse").collapse("hide");
    });

    // Activate scrollspy to add active class to navbar items on scroll
	if ( $( "#sideNav" ).length ) {
		$('body').scrollspy({ target: '#sideNav', offset: 50 }); 
		//$("body").scrollspy({target: "#sideNav"});
	}
    
})(jQuery); // End of use strict




$("#tab1").addClass("tab-active");

$("#next-btn").click(function () {
  $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").show();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab2").addClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");

});

$("#bck-btn").click(function () {
    $("#comp-info").show();
    $("#detail-form").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab2").removeClass("tab-active");
    $("#tab1").addClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});


$(document).ready(function () {
    /*$('#companyDetail').validate({
        rules: {
            Companyname: "required"
        },
        messages: {
            Companyname: {
                required: "Provide a Company Name",
            },
            b_address: {
                required: "Provide a Address ",
            },
            b_city: {
                required: "Provide a City ",
            },
            b_state: {
                required: "Provide a State ",
            },
            b_zipcode: {
                required: "Provide a Zip Code ",
            },
            b_country: {
                required: "Provide a Country",
            },
            b_EINnumber: {
                required: "Provide a EIN Number",
            },
            b_Establishmentyear: {
                required: "Provide a Establishment Year",
            },
            b_business_user_tag: {
                required: "Provide a Business Username",
            },

        }
    });*/
    /*$('#empHistory').validate({
        rules: {
            empcompname: "required",
            todateval: "required"
        },
        messages: {
            empcompname: {
                required: "Provide a Company Name",
            },
            empposition: {
                required: "Provide a Position ",
            },
            fromdateval: {
                required: "Provide a From Date ",
            },
            todateval: {
                required: "Provide a To Date ",
            },
            empdegree: {
                required: "Provide a Degree - Course ",
            },
            empuni: {
                required: "Provide a University - School",
            },
            empyear: {
                required: "Provide a Year Graduated",
            },

        }

    });*/
    $('#serviceSpecifics').validate({
        rules: {
            Language: "required",
            serTimeZone: "required",
            serDayoff: "required",
            serBusinessoff: "required"
        },
        messages: {
            Language: {
                required: "Select a Language",
            },
            serTimeZone: {
                required: "Select a Time Zone",
            },
            serDayoff: {
                required: "Provide a Days Off",
            },
            checkyes: {
                required: "Select a Data",
            },
            check_yes: {
                required: "Select a Data",
            },
        }
    });
    $('#creService').validate({
        rules: {
            crespname: "required",
            cresdesc: "required",
            cresbookingdays: "required",
            cresbookingval: "required",
            cresbookdays: "required",
            cresbookval: "required"
        },
        messages: {
            crespname: {
                required: "Enter program name",
            },
            cresdesc: {
                required: "Enter program description",
            },
            cresbookingdays: {
                required: "Please Select",
            },
            cresbookingval: {
                required: "Please Select",
            },
            cresbookdays: {
                required: "Please Select",
            },
            cresbookval: {
                required: "Please Select",
            },

        }
    });

});

var verr = ''

function ajax(v) {
    if (v != '') {
        $.ajax({
            url: '/mybusinessusertag',
            type: 'POST',
            dataType: 'json',
            data: {
                email: v
            },
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            success: function (response) {

                if (response.count != 0) {
                    // $(".b_eml").text(response.msg).show();
                    //setTimeout(function(){ $(".b_eml").hide(); }, 4000);
                    verr = 'This tag has already taken, choose another one.'
                    showSystemMessages('#systemMessage1', 'danger', 'This tag has already taken, choose another one.');
                    // $('#b_usertag').text('This tag has already taken, choose another one.');
                } else {
                    verr = ''
                    $('#b_usertag').text('')
                }
            }
        });
    }
}

$("#b_Establishmentyear").change(function () {
    //console.log("ggfh")
    var a = $("#b_Establishmentyear").val();
    if (a > new Date().getFullYear()) {
        showSystemMessages('#systemMessage1', 'danger', 'Establishment Year shoud be less than current year.');
        // $("#b_estb").text("Establishment Year shoud be less than current year");
    } else {
        $("#b_estb").text("");
    }
})
$("#passingyear").change(function () {
    //console.log("ggfh")
    var a = $("#passingyear").val();
    if (a > new Date().getFullYear()) {
        showSystemMessages('#systemMessage1', 'danger', 'Passing year shoud be less than current year.');
        // $("#b_year").text("Passing year shoud be less than current year");
    } else {
        $("#b_year").text("");
    }
})
var profile_pic_var = '';
var add_service_var = '';
var formdata = new FormData();
$('.percentage').keyup(function () {
    var val = parseInt($(this).val());
    if ($.isNumeric(val)) {
        if (val == 0) {
            $(this).val('');
            $('#taxmsg').text('Please enter the value greater than 0').show();
            setTimeout(function () {
                $('#taxmsg').hide()
            }, 3000);
        }
        if (val > 100) {
            $(this).val('');
            $('#taxmsg').text('Please enter the value less than 100').show();
            setTimeout(function () {
                $('#taxmsg').hide()
            }, 3000);
            return false;
        }
    } else {
        $(this).val('');
        $('#taxmsg').text('Please enter only numbers').show();
        setTimeout(function () {
            $('#taxmsg').hide()
        }, 3000);
    }

});
$('.setnumber').keyup(function () {
    var val = parseInt($(this).val());
    if ($.isNumeric(val)) {
        if (val == 0) {
            $(this).val('');
            $('#setnumbermsg').text('Please enter the value greater than 0').show();
            setTimeout(function () {
                $('#taxmsg').hide()
            }, 3000);
        }
        if (val > 100) {
            $(this).val('');
            $('#setnumbermsg').text('Please enter the value less than 100').show();
            setTimeout(function () {
                $('#setnumbermsg').hide()
            }, 3000);
        }
    } else {
        $(this).val('');
        $('#setnumbermsg').text('Please enter only numbers').show();
        setTimeout(function () {
            $('#setnumbermsg').hide()
        }, 3000);
    }
});
$('#select_box_number').change(function () {
    //$("#number_span").text($('#select_box_number').val())
    if ($('#numberofpays').val() != '') {
        var k = $('#select_box_number').val()
        var l = $('#numberofpays').val()
        var j = k * l
        $("#number_span").text(j)
    }
    //console.log($('#select_box_number').val())
})
$('#select_box_month').change(function () {
    $("#month_span").text($('#select_box_month').val())
    //console.log($('#select_box_month').val())
})
$('#numberofpays').keyup(function () {
    if ($('#numberofpays').val() == '') {
        $("#number_span").text(0)
    } else {
        var k = $('#select_box_number').val()
        var l = $('#numberofpays').val()
        var j = k * l
        $("#number_span").text(j)
    }
})
$(".myautopay").click(function () {
    var willing_to_travel_radio = $(this).find('input[type=radio]').val();
    if (willing_to_travel_radio == 0) {
        $('#myautopaynum').show();
        $('#monthtomonth').show();
    } else {
        $('#monthtomonth').hide();
        $('#myautopaynum').hide();
    }
});
//});

$("#btn-nxt1").click(function () {

    //if($("#companyDetail").valid()){
    /*$("#comp-info").hide();
    $("#detail-form").hide();
    $("#detail-form1").show();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab3").addClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab5").removeClass("tab-active"); */

    $(".error").empty();
    //ajax($('#b_business_user_tag').val());
    //$('#b_usertag').change();
    if ($("#b_companyname").val() != '') {
        if ($("#b_address").val() != '') {
            if ($("#b_state").val() != '') {
                if ($("#b_city").val() != '') {
                    if ($("#b_zipcode").val() != '') {
                        if ($("#b_country").val() != '') {
                            if ($("#b_EINnumber").val() != '') {
                                if ($('#b_Establishmentyear').val() != "") {
                                    if ($('#b_business_user_tag').val() != "") {
                                        if ($('#profile_pic').val() != "") {
                                            if ($('#b_firstname').val() != "") {
                                                if ($('#b_lastname').val() != "") {
                                                    if ($('#b_contact').val() != "") {
                                                        if ($('#about_company').val() != "") {

                                                            if ($('#short_description').val() != "") {
                                                                if ($('#b_Establishmentyear').val() <= new Date().getFullYear()) {
                                                                    console.log($('#b_estb').text())
                                                                    if (verr == '' && $("#b_estb").text() == '') {
                                                                        console.log("rwre")
                                                                        $('#prev_companyname').text($("#b_companyname").val())
                                                                        $('#prev_einnumber').text($("#b_EINnumber").val())
                                                                        $('#prev_establishmentyear').text($("#b_Establishmentyear").val())
                                                                        $('#prev_address').text($("#b_address").val())
                                                                        $('#prev_state').text($("#b_state").val())
                                                                        $('#prev_city').text($("#b_city").val())
                                                                        $('#prev_zipcode').text($("#b_zipcode").val())
                                                                        $('#prev_country').text($("#b_country").val())
                                                                        $('#prev_business_user_tag').text($("#b_business_user_tag").val())
                                                                        formdata.append('company_name', $("#b_companyname").val())
                                                                        formdata.append('address', $("#b_address").val())
                                                                        formdata.append('state', $("#b_state").val())
                                                                        formdata.append('city', $("#b_city").val())
                                                                        formdata.append('zipcode', $("#b_zipcode").val())
                                                                        formdata.append('ein_number', $("#b_EINnumber").val())
                                                                        formdata.append('establishment_year', $("#b_Establishmentyear").val())
                                                                        formdata.append('country', $("#b_country").val())
                                                                        formdata.append('business_user_tag', $("#b_business_user_tag").val())
                                                                        formdata.append('latitude', lat)
                                                                        formdata.append('longitude', long)
                                                                        $('#company_info').hide();
                                                                        $('#company_education_skill').show();

                                                                        $("#comp-info").hide();
                                                                        $("#detail-form").hide();
                                                                        $("#detail-form1").show();
                                                                        $("#bookings1").hide();
                                                                        $("#detail-form2").hide();
                                                                        $("#detail-form3").hide();
                                                                        $("#verified-form").hide();
                                                                        $("#verified-form1").hide();
                                                                        $("#verified-form2").hide();
                                                                        $("#verified-form3").hide();
                                                                        $("#verified-form4").hide();
                                                                        $("#detail-form4").hide();
                                                                        $("#detail-form5").hide();
                                                                        $("#detail-form6").hide();
                                                                        $("#detail-form7").hide();
                                                                        $("#detail-form8").hide();
                                                                        $("#detail-form9").hide();
                                                                        $("#detail-form10").hide();
                                                                        $("#experiences1").hide();
                                                                        $("#experiences2").hide();    
                                                                        $("#experiences3").hide();
                                                                        $("#classes_1").hide();
                                                                        $("#classes_2").hide();
                                                                        $("#classes_3").hide();
                                                                        $("#classes_4").hide();
                                                                        $("#classes_5").hide();
                                                                        $("#tab1").removeClass("tab-active");
                                                                        $("#tab3").addClass("tab-active");
                                                                        $("#tab2").removeClass("tab-active");
                                                                        $("#tab4").removeClass("tab-active");
                                                                        $("#tab5").removeClass("tab-active");
                                                                        $("#tab6").removeClass("tab-active");
                                                                        $("#tab7").removeClass("tab-active");
                                                                        $("#tab8").removeClass("tab-active");
                                                                    }
                                                                } else {
                                                                    showSystemMessages('#systemMessage1', 'danger', 'Establishment Year shoud be less than current year');
                                                                }
                                                            } else {
                                                                showSystemMessages('#systemMessage1', 'danger', 'Please Enter The Business Short Description');
                                                            }
                                                        } else {
                                                            showSystemMessages('#systemMessage1', 'danger', 'Please Enter The Quick Business Info');
                                                        }
                                                    } else {
                                                        showSystemMessages('#systemMessage1', 'danger', 'Please Enter The Phonenumber');
                                                    }
                                                } else {
                                                    showSystemMessages('#systemMessage1', 'danger', 'Please Enter The Lastname');
                                                }

                                            } else {
                                                showSystemMessages('#systemMessage1', 'danger', 'Please Enter The Firstname');
                                            }
                                        } else {
                                            showSystemMessages('#systemMessage1', 'danger', 'Please Select Profile Picture');
                                        }
                                    } else {
                                        showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Business Username');
                                    }
                                } else {
                                    showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Establishment Year');
                                }
                            } else {
                                showSystemMessages('#systemMessage1', 'danger', 'Please Enter the EIN number');
                            }
                        } else {
                            showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Country name');
                        }
                    } else {
                        showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Zip code');
                    }
                } else {
                    showSystemMessages('#systemMessage1', 'danger', 'Please Enter the City');
                }
            } else {
                showSystemMessages('#systemMessage1', 'danger', 'Please Enter the State');
            }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Address');
        }
    } else {
        showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Company');
    }

});

$("#bck-btn1").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").show();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab2").addClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#btn-nxt2").click(function () {
    /*if ($("#empHistory").valid()) {
        $("#comp-info").hide();
        $("#detail-form").hide();
        $("#detail-form1").hide();
        $("#detail-form2").show();
        $("#detail-form3").hide();
        $("#detail-form4").hide();
        $("#detail-form5").hide();
        $("#detail-form6").hide();
        $("#detail-form7").hide();
        $("#tab1").removeClass("tab-active");
        $("#tab4").addClass("tab-active");
        $("#tab3").removeClass("tab-active");
        $("#tab2").removeClass("tab-active");
        $("#tab5").removeClass("tab-active");
    } else {
        return false;
    }*/
    if ($('#passingyear').val() <= new Date().getFullYear()) {

        // if($("#skillcompletionpicker").val()!=''){

        formdata.append('organization', $("input:text[name='frm_organization']").val())

        formdata.append('position', $("input:text[name='frm_position']").val())

        formdata.append('service_start', $("input:text[name='frm_servicestart']").val())

        formdata.append('service_end', $("input:text[name='frm_serviceend']").val())

        formdata.append('is_present', $("#frm_ispresent").val())

        formdata.append('course', $("#frm_course").val())

        formdata.append('university', $("#frm_university").val())

        formdata.append('passing_year', $("#passingyear").val())

        formdata.append('title', $("#certification").val())

        formdata.append('completion_date', $("#completionyear").val())

        formdata.append('type', $("#skiils_achievments_awards1").val())

        formdata.append('skill_completion_date', $("#skillcompletionpicker").val())

        formdata.append('skill_detail', $("#frm_skilldetail").val())



        $('#prev_degree').text($("#frm_course").val())

        $('#prev_university').text($("#frm_university").val())

        $('#prev_yeargraduate').text($("#passingyear").val())

        $('#prev_nameofcertification').text($("#certification").val())

        $('#prev_completiondate').text($("#completionyear").val())

        $('#prev_skilltype').text($("#skiils_achievments_awards").val())

        $('#prev_skilldetail').text($("#frm_skilldetail").val())

        $('#prev_skillcompletion').text($("#skillcompletionpicker").val())

        $('#prev_organisationname').text($("input:text[name='frm_organization']").val())

        $('#prev_position').text($("input:text[name='frm_position']").val())

        $('#prev_servicestart').text($("#dp1").val())

        $('#prev_serviceend').text($("#dp2").val())

        $('#company_education_skill').hide();

        $('#step4').show();

        $("#comp-info").hide();

        $("#detail-form").hide();

        $("#detail-form1").hide();
        
        $("#bookings1").show();

        $("#detail-form2").hide();

        $("#detail-form3").hide();

        $("#verified-form").hide();

        $("#verified-form1").hide();

        $("#verified-form2").hide();

        $("#verified-form3").hide();

        $("#verified-form4").hide();

        $("#detail-form4").hide();

        $("#detail-form5").hide();

        $("#detail-form6").hide();

        $("#detail-form7").hide();

        $("#detail-form8").hide();

        $("#detail-form9").hide();

        $("#detail-form10").hide();
        
        $("#experiences1").hide();
        $("#experiences2").hide();    
        $("#experiences3").hide();
        
        $("#classes_1").hide();
        $("#classes_2").hide();
        $("#classes_3").hide();
        $("#classes_4").hide();
        $("#classes_5").hide();

        $("#tab1").removeClass("tab-active");

        $("#tab4").addClass("tab-active");

        $("#tab3").removeClass("tab-active");

        $("#tab2").removeClass("tab-active");

        $("#tab5").removeClass("tab-active");

        $("#tab6").removeClass("tab-active");

        $("#tab7").removeClass("tab-active");
        $("#tab8").removeClass("tab-active");

        //}

        //   else{

        //       showSystemMessages('#systemMessage1', 'danger', 'Please Enter the skill completion date.');



        // }

    } else {

        showSystemMessages('#systemMessage1', 'danger', 'Passing Year shoud be less than current year');



    }

    //             }

    //             else{

    //                 showSystemMessages('#systemMessage1', 'danger', 'Please select skill type');



    //             }

    //     }else{

    //         showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Certication completion date');



    //     }

    // }else{

    //     showSystemMessages('#systemMessage1', 'danger', 'Please Enter the certification');



    // }

    //             }

    //             else{

    //     showSystemMessages('#systemMessage1', 'danger', 'Please select passing year');

    //   }



    //     }

    //     else{

    //   showSystemMessages('#systemMessage1', 'danger', 'Please Enter the university');



    //     }

    // }

    // else{

    // showSystemMessages('#systemMessage1', 'danger', 'Please enter the course');



    // }



    // }else{

    // showSystemMessages('#systemMessage1', 'danger', 'Please enter the To Date');



    // } 

    // }else{

    // showSystemMessages('#systemMessage1', 'danger', 'PPlease enter the From Date');



    // }    

    // }else{

    // showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Position');



    // }    

    // }else{

    // showSystemMessages('#systemMessage1', 'danger', 'Please Enter the organistaion name');



    // }


});

$("#bck-btn2").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").show();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab3").removeClass("tab-active");
    $("#tab1").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").addClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#book-nxt1").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form2").show();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab3").removeClass("tab-active");
    $("#tab1").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab5").addClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#book-back1").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").show();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab3").addClass("tab-active");
    $("#tab1").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#btn-nxt3").click(function () {
    /*if ($("#serviceSpecifics").valid()) {
        $("#comp-info").hide();
        $("#detail-form").hide();
        $("#detail-form1").hide();
        $("#detail-form2").hide();
        $("#detail-form3").show();
        $("#detail-form4").hide();
        $("#detail-form5").hide();
        $("#detail-form6").hide();
        $("#detail-form7").hide();
        $("#tab1").removeClass("tab-active");
        $("#tab5").addClass("tab-active");
        $("#tab3").removeClass("tab-active");
        $("#tab4").removeClass("tab-active");
        $("#tab2").removeClass("tab-active")
    } else {
        return false;
    }*/

    $(".error").empty();
    //ajax($('#b_business_user_tag').val());
    //$('#b_usertag').change();
    var checkyes = 0;
    var check_yes = 0;
    if ($("#testdemo").val() != '' && $("#testdemo").val() != 'null' && $("#testdemo").val() != null) {
        if (document.getElementById('checkyes').checked == true || document.getElementById('checkno').checked == true) {
            if (document.getElementById('checkyes').checked == true) {
                console.log('checkyes');
                checkyes = 1;
            }
            if (document.getElementById('check_yes').checked == true || document.getElementById('check_no').checked == true) {
                if (document.getElementById('check_yes').checked == true) {
                    console.log('check_yes');
                    check_yes = 1;
                }
                if ($("#serTimeZone").val() != '' && $("#serTimeZone").val() != 'null' && $("#serTimeZone").val() != null) {
                    if ($("#mdp-demo").val() != '') {
                        if (checkyes == 1) {
                            if ($("#mcc").val() != '' && $("#mcc").val() != 'null' && $("#mcc").val() != null) {
                                checkyes = 0;
                            } else {
                                checkyes == 1;
                            }
                        }
                        if (check_yes == 1) {
                            if ($("#fitness_goals_array").val() != '' && $("#fitness_goals_array").val() != 'null' && $("#fitness_goals_array").val() != null) {
                                check_yes = 0;
                            } else {
                                check_yes = 1;
                            }

                        }
                        if (check_yes == 0 && checkyes == 0) {

                            $('#prev_testdemo').text($("#testdemo").val())
                            $('#prev_checkyes').text($("#checkyes").val())
                            $('#prev_mcc').text($("#mcc").val())
                            $('#prev_check_yes').text($("#check_yes").val())
                            $('#prev_fitness_goals_array').text($("#fitness_goals_array").val())
                            $('#prev_serTimeZone').text($("#serTimeZone").val())
                            $('#prev_mdp-demo').text($("#mdp-demo").val())

                            formdata.append('language', $("#testdemo").val())
                            formdata.append('medical_conditions', $("#checkyes").val())
                            formdata.append('what_type', $("#mcc").val())
                            formdata.append('fitness_goals', $("#check_yes").val())
                            formdata.append('what_type', $("#fitness_goals_array").val())
                            formdata.append('time_zone', $("#serTimeZone").val())
                            formdata.append('day_off', $("#mdp-demo").val())

                            $('#company_info').hide();
                            $('#company_education_skill').show();


                            $("#comp-info").hide();
                            $("#detail-form").hide();
                            $("#detail-form1").hide();
                            $("#bookings1").hide();
                            $("#detail-form2").hide();
                            $("#detail-form3").show();
                            $("#verified-form").hide();
                            $("#verified-form1").hide();
                            $("#verified-form2").hide();
                            $("#verified-form3").hide();
                            $("#verified-form4").hide();
                            $("#detail-form4").hide();
                            $("#detail-form5").hide();
                            $("#detail-form6").hide();
                            $("#detail-form7").hide();
                            $("#detail-form8").hide();
                            $("#detail-form9").hide();
                            $("#detail-form10").hide();
                            $("#experiences1").hide();
                            $("#experiences2").hide();    
                            $("#experiences3").hide();
                            $("#classes_1").hide();
                            $("#classes_2").hide();
                            $("#classes_3").hide();
                            $("#classes_4").hide();
                            $("#classes_5").hide();
                            $("#tab1").removeClass("tab-active");
                            $("#tab5").removeClass("tab-active");
                            $("#tab3").removeClass("tab-active");
                            $("#tab4").removeClass("tab-active");
                            $("#tab2").removeClass("tab-active");
                            $("#tab6").addClass("tab-active");
                            $("#tab7").removeClass("tab-active");
                            $("#tab8").removeClass("tab-active");
                        } else {
                            if (checkyes == 1)
                                showSystemMessages('#systemMessage1', 'danger', 'Please Select Where Do You Work With Client');
                            else
                                showSystemMessages('#systemMessage1', 'danger', 'Please Enter the clients with these fitness goals');
                        }
                    } else {
                        showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Any Special Days Off');
                    }
                } else {
                    showSystemMessages('#systemMessage1', 'danger', 'Please Enter the time zone');
                }
            } else {
                showSystemMessages('#systemMessage1', 'danger', 'Please Enter the clients with these fitness goals');
            }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Please Select Where Do You Work With Client');
        }
    } else {
        showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Language you and your staff speak');
    }


});

$("#bck-btn3").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form2").show();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab5").addClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#btn-nxt4").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").show();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").addClass("subtab-active");
});

$("#bck-btn4").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").show();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").addClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#btn-nxt5").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form1").show();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
    $("#tab8").removeClass("tab-active");
});

$("#bck-btn5").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#detail-form2").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").show();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#back_verified").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form").hide();
    $("#detail-form3").hide();
    $("#detail-form2").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").show();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#verified_1").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form1").hide();
    $("#verified-form2").show();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
    $("#full_name").val($('#first_name').val());
});

$("#back_verified_1").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form").hide();
    $("#detail-form3").hide();
    $("#detail-form2").hide();
    $("#verified-form1").show();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#verified_2").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").show();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#back_verified_2").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#detail-form2").hide();
    $("#verified-form1").hide();
    $("#verified-form2").show();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#verified_3").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").show();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").addClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#back_verified_3").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#detail-form2").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").show();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#verified_4").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").show();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#back_verified_4").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form").hide();
    $("#detail-form3").hide();
    $("#detail-form2").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").show();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});


$("#btn-nxt6").click(function () {
    
	$("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();    
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").show();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").addClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
	
});

$("#bck-btn6").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").show();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});


$("#btn-nxt7").click(function () {

    /*if ($("#creService").valid()) {
        $("#comp-info").hide();
        $("#detail-form").hide();
        $("#detail-form1").hide();
        $("#detail-form2").hide();
        $("#detail-form3").hide();
        $("#detail-form4").hide();
        $("#detail-form5").hide();
        $("#detail-form6").show();
        $("#detail-form7").hide();
        $("#detail-form8").hide();
        $("#detail-form9").hide();
        $("#tab1").removeClass("tab-active");
        $("#tab5").removeClass("tab-active");
        $("#tab3").removeClass("tab-active");
        $("#tab4").removeClass("tab-active");
        $("#tab2").removeClass("tab-active");
        $("#tab6").addClass("tab-active");
        $(".subtab").addClass("subtab-active");
    } else {
        return false;
    }*/
    if ($("#frm_servicesport").val() != '' && $("#frm_servicesport").val() != 'null' && $(frm_servicesport).val() != null) {
        if ($("#frm_servicetitle_two").val() != '' && $("#frm_servicetitle_two").val() != 'null' && $(frm_servicetitle_two).val() != null) {
            $("#comp-info").hide();
            $("#detail-form").hide();
            $("#bookings1").hide();
            $("#detail-form1").hide();
            $("#detail-form2").hide();
            $("#detail-form3").hide();
            $("#verified-form").hide();
            $("#verified-form1").hide();
            $("#verified-form2").hide();
            $("#verified-form3").hide();
            $("#verified-form4").hide();
            $("#detail-form4").hide();
            $("#detail-form5").hide();
            $("#detail-form6").hide();
            $("#detail-form7").show();
            $("#detail-form8").hide();
            $("#detail-form9").hide();
            $("#detail-form10").hide();
            $("#experiences1").hide();
            $("#experiences2").hide();    
            $("#experiences3").hide();
            $("#classes_1").hide();
            $("#classes_2").hide();
            $("#classes_3").hide();
            $("#classes_4").hide();
            $("#classes_5").hide();
            $("#tab1").removeClass("tab-active");
            $("#tab5").removeClass("tab-active");
            $("#tab3").removeClass("tab-active");
            $("#tab4").removeClass("tab-active");
            $("#tab2").removeClass("tab-active");
            $("#tab6").removeClass("tab-active");
            $("#tab7").removeClass("tab-active");
            $("#tab8").addClass("tab-active");
            $(".subtab").addClass("subtab-active");
            $(".subtab1").removeClass("subtab-active");
            $(".subtab2").removeClass("subtab-active");

            $("#frm_servicetitle").val($('#frm_servicetitle_two').val());
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Please Enter the Program Name');
        }
    } else {
        showSystemMessages('#systemMessage1', 'danger', 'Please Select the Activity');
    }


});

$("#bck-btn7").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").show();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").addClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});


$("#btn-nxt8").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").show();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").addClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#bck-btn8").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").show();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").addClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#btn-nxt9").click(function () {
    /*$("#comp-info").hide();
    $("#detail-form").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").show();
    $("#detail-form10").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $(".subtab").addClass("subtab-active");*/

    $(".error").empty();

    if ($("#categ").val() != '' && $("#categ").val() != 'null' && $(categ).val() != null) {
        if ($("#frm_servicelocation").val() != '' && $("#frm_servicelocation").val() != 'null' && $(frm_servicelocation).val() != null) {
            if ($("#frm_programfor").val() != '' && $("#frm_programfor").val() != 'null' && $(frm_programfor).val() != null) {
                if ($("#frm_agerange").val() != '' && $("#frm_agerange").val() != 'null' && $(frm_agerange).val() != null) {
                    if ($("#frm_numberofpeople").val() != '' && $("#frm_numberofpeople").val() != 'null' && $(frm_numberofpeople).val() != null) {
                        if ($("#frm_experience_level").val() != '' && $("#frm_experience_level").val() != 'null' && $(frm_experience_level).val() != null) {
                            if ($("#frm_servicefocuses").val() != '' && $("#frm_servicefocuses").val() != 'null' && $(frm_servicefocuses).val() != null) {
                                if ($("#teaching").val() != '' && $("#teaching").val() != 'null' && $(teaching).val() != null) {

                                    $("#comp-info").hide();
                                    $("#detail-form").hide();
                                    $("#bookings1").hide();
                                    $("#detail-form1").hide();
                                    $("#detail-form2").hide();
                                    $("#detail-form3").hide();
                                    $("#verified-form").hide();
                                    $("#verified-form1").hide();
                                    $("#verified-form2").hide();
                                    $("#verified-form3").hide();
                                    $("#verified-form4").hide();
                                    $("#detail-form4").hide();
                                    $("#detail-form5").hide();
                                    $("#detail-form6").hide();
                                    $("#detail-form7").hide();
                                    $("#detail-form8").hide();
                                    $("#detail-form9").show();
                                    $("#detail-form10").hide();
                                    $("#experiences1").hide();
                                    $("#experiences2").hide();    
                                    $("#experiences3").hide();
                                    $("#classes_1").hide();
                                    $("#classes_2").hide();
                                    $("#classes_3").hide();
                                    $("#classes_4").hide();
                                    $("#classes_5").hide();
                                    $("#tab1").removeClass("tab-active");
                                    $("#tab5").removeClass("tab-active");
                                    $("#tab3").removeClass("tab-active");
                                    $("#tab4").removeClass("tab-active");
                                    $("#tab2").removeClass("tab-active");
                                    $("#tab6").removeClass("tab-active");
                                    $("#tab7").removeClass("tab-active");
                                    $("#tab8").addClass("tab-active");
                                    $(".subtab").addClass("subtab-active");
                                    $(".subtab1").removeClass("subtab-active");
                                    $(".subtab2").removeClass("subtab-active");
                                } else {
                                    showSystemMessages('#systemMessage1', 'danger', 'Please Select Personality & Habits of Provider');
                                }
                            } else {
                                showSystemMessages('#systemMessage1', 'danger', 'Please Select Activity Experience');
                            }
                        } else {
                            showSystemMessages('#systemMessage1', 'danger', 'Please Select Difficulty Level');
                        }
                    } else {
                        showSystemMessages('#systemMessage1', 'danger', 'Please Select Group Size');
                    }
                } else {
                    showSystemMessages('#systemMessage1', 'danger', 'Please Select Age Range');
                }
            } else {
                showSystemMessages('#systemMessage1', 'danger', 'Please Select Activity Great For');
            }
        } else {
            showSystemMessages('#systemMessage1', 'danger', 'Please Select Location of Activity');
        }
    } else {
        showSystemMessages('#systemMessage1', 'danger', 'Please Select Service Type');
    }

});

$("#bck-btn9").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").show();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").addClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#btn-nxt10").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").show();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").addClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#bck-btn10").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").show();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").addClass("subtab-active");    
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

/*$("#btn-nxt11").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").addClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});*/

$("#bck-btn11").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").show();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#btn-nxt12").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").show();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").addClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
    $("#frm_servicetitle1").val($('#frm_servicetitle_1').val());
});

$("#bck-btn12").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").show();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").addClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#btn-nxt13").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").show();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").addClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#bck-btn13").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").show();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").addClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#btn-nxt14").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").show();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").addClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#bck-btn14").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").show();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").addClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#btn-nxt15").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").show();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").addClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#bck-btn15").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").show();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").addClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

/*$("#btn-nxt16").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").show();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").addClass("subtab-active");
});*/

$("#bck-btn16").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").show();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#btn-nxt17").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").show();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").addClass("subtab-active");
    $("#frm_servicetitle2").val($('#frm_servicetitle_2').val());
});

$("#bck-btn17").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").show();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").addClass("subtab-active");
});

$("#btn-nxt18").click(function () {
    $("#comp-info").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").show();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").addClass("subtab-active");
});

$("#bck-btn18").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").show();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").addClass("subtab-active");
});

$("#tab1").click(function () {
    $("#comp-info").show();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab2").removeClass("tab-active");
    $("#tab1").addClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#tab2").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").show();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab2").addClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#tab3").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").show();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab3").addClass("tab-active");
    $("#tab1").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#tab4").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").show();
    $("#detail-form2").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab4").addClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#tab5").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").show();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").addClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#tab6").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#bookings1").hide();
    $("#detail-form").hide();
    $("#detail-form3").show();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").addClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").removeClass("tab-active");
});

$("#tab7").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").show();
    $("#detail-form5").hide();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").addClass("tab-active");
    $("#tab8").removeClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("#tab8").click(function () {
    $("#comp-info").hide();
    $("#detail-form1").hide();
    $("#detail-form").hide();
    $("#bookings1").hide();
    $("#detail-form3").hide();
    $("#verified-form").hide();
    $("#verified-form1").hide();
    $("#verified-form2").hide();
    $("#verified-form3").hide();
    $("#verified-form4").hide();
    $("#detail-form2").hide();
    $("#detail-form4").hide();
    $("#detail-form5").show();
    $("#detail-form6").hide();
    $("#detail-form7").hide();
    $("#detail-form8").hide();
    $("#detail-form9").hide();
    $("#detail-form10").hide();
    $("#experiences1").hide();
    $("#experiences2").hide();    
    $("#experiences3").hide();
    $("#classes_1").hide();
    $("#classes_2").hide();
    $("#classes_3").hide();
    $("#classes_4").hide();
    $("#classes_5").hide();
    $("#tab1").removeClass("tab-active");
    $("#tab5").removeClass("tab-active");
    $("#tab3").removeClass("tab-active");
    $("#tab2").removeClass("tab-active");
    $("#tab4").removeClass("tab-active");
    $("#tab6").removeClass("tab-active");
    $("#tab7").removeClass("tab-active");
    $("#tab8").addClass("tab-active");
    $(".subtab").removeClass("subtab-active");
    $(".subtab1").removeClass("subtab-active");
    $(".subtab2").removeClass("subtab-active");
});

$("input[name='radio-group']").click(function () {
    var servicetype=$("input[name='radio-group']:checked").val();
    if(servicetype=='classes')
	{
        $("#comp-info").hide();
        $("#detail-form1").hide();
        $("#detail-form").hide();
        $("#bookings1").hide();
        $("#detail-form3").hide();
        $("#verified-form").hide();
        $("#verified-form1").hide();
        $("#verified-form2").hide();
        $("#verified-form3").hide();
        $("#verified-form4").hide();
        $("#detail-form2").hide();
        $("#detail-form4").hide();
        $("#detail-form5").hide();
        $("#detail-form6").hide();
        $("#detail-form7").hide();
        $("#detail-form8").hide();
        $("#detail-form9").hide();
        $("#detail-form10").hide();
        $("#experiences1").hide();
        $("#experiences2").hide();    
        $("#experiences3").hide();
        $("#classes_1").show();
        $("#classes_2").hide();
        $("#classes_3").hide();
        $("#classes_4").hide();
        $("#classes_5").hide();
        $("#tab1").removeClass("tab-active");
        $("#tab5").removeClass("tab-active");
        $("#tab3").removeClass("tab-active");
        $("#tab2").removeClass("tab-active");
        $("#tab4").removeClass("tab-active");
        $("#tab6").removeClass("tab-active");
        $("#tab7").removeClass("tab-active");
        $("#tab8").addClass("tab-active");
        $(".subtab").removeClass("subtab-active");
        $(".subtab1").addClass("subtab-active");
        $(".subtab2").removeClass("subtab-active");
    }
    
});

$("input[name='radio-group']").click(function () {
    var servicetype=$("input[name='radio-group']:checked").val();
    if(servicetype=='individual')
	{
        $("#comp-info").hide();
        $("#detail-form1").hide();
        $("#detail-form").hide();
        $("#bookings1").hide();
        $("#detail-form3").hide();
        $("#verified-form").hide();
        $("#verified-form1").hide();
        $("#verified-form2").hide();
        $("#verified-form3").hide();
        $("#verified-form4").hide();
        $("#detail-form2").hide();
        $("#detail-form4").hide();
        $("#detail-form5").hide();
        $("#detail-form6").show();
        $("#detail-form7").hide();
        $("#detail-form8").hide();
        $("#detail-form9").hide();
        $("#detail-form10").hide();
        $("#experiences1").hide();
        $("#experiences2").hide();    
        $("#experiences3").hide();
        $("#classes_1").hide();
        $("#classes_2").hide();
        $("#classes_3").hide();
        $("#classes_4").hide();
        $("#classes_5").hide();
        $("#tab1").removeClass("tab-active");
        $("#tab5").removeClass("tab-active");
        $("#tab3").removeClass("tab-active");
        $("#tab2").removeClass("tab-active");
        $("#tab4").removeClass("tab-active");
        $("#tab6").removeClass("tab-active");
        $("#tab7").removeClass("tab-active");
        $("#tab8").addClass("tab-active");
        $(".subtab").addClass("subtab-active");
        $(".subtab1").removeClass("subtab-active");
        $(".subtab2").removeClass("subtab-active");
    }
    
});

$("input[name='radio-group']").click(function () {
    var servicetype=$("input[name='radio-group']:checked").val();
    if(servicetype=='experience')
	{
        $("#comp-info").hide();
        $("#detail-form1").hide();
        $("#detail-form").hide();
        $("#bookings1").hide();
        $("#detail-form3").hide();
        $("#verified-form").hide();
        $("#verified-form1").hide();
        $("#verified-form2").hide();
        $("#verified-form3").hide();
        $("#verified-form4").hide();
        $("#detail-form2").hide();
        $("#detail-form4").hide();
        $("#detail-form5").hide();
        $("#detail-form6").hide();
        $("#detail-form7").hide();
        $("#detail-form8").hide();
        $("#detail-form9").hide();
        $("#detail-form10").hide();
        $("#experiences1").show();
        $("#experiences2").hide();    
        $("#experiences3").hide();
        $("#classes_1").hide();
        $("#classes_2").hide();
        $("#classes_3").hide();
        $("#classes_4").hide();
        $("#classes_5").hide();
        $("#tab1").removeClass("tab-active");
        $("#tab5").removeClass("tab-active");
        $("#tab3").removeClass("tab-active");
        $("#tab2").removeClass("tab-active");
        $("#tab4").removeClass("tab-active");
        $("#tab6").removeClass("tab-active");
        $("#tab7").removeClass("tab-active");
        $("#tab8").addClass("tab-active");
        $(".subtab").removeClass("subtab-active");
        $(".subtab1").removeClass("subtab-active");
        $(".subtab2").addClass("subtab-active");
    }
    
});


$(document).ready(function () {

    $("#checkyes").click(function () {
        $("#medproblm").show();
    });
    $("#checkno").click(function () {
        $("#medproblm").hide();
    });

    $("#checkserviceyes").click(function () {
        $("#servicebox").show();
        $('.where_do_you_work').show();
        $('.service_type').removeClass("fixed_service");
        var rad_val = $("input[type='radio'][name='willing_to_travel']:checked").val();

        /*var willing_to_travel_radio = $(this).find('input[type=radio]');
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');*/

        if (rad_val == 'yes') {
            $(".travel_miles_div").prop("disabled", false);
            $('.travel_miles_div').show();
            $('.where_do_you_work').show();

        } else {
            $(".travel_miles_div").prop("disabled", true);
            $('.travel_miles_div').hide();
            $('.where_do_you_work').show();
        }
    });
    $("#checkserviceno").click(function () {
        $("#servicebox").hide();
        $('.where_do_you_work').hide();
        $('.service_type').addClass("fixed_service");
        var rad_val = $("input[type='radio'][name='willing_to_travel']:checked").val();
        if (rad_val == 'no') {
            $(".travel_miles_div").prop("disabled", true);
            $('.travel_miles_div').hide();
            $('.where_do_you_work').hide();
        } else {
            $(".travel_miles_div").prop("disabled", false);
            $('.travel_miles_div').show();
            $('.where_do_you_work').hide();
        }
    });

    $("#check_yes").click(function () {
        $("#fit-goals").show();
    });
    $("#check_no").click(function () {
        $("#fit-goals").hide();
    });
    
    $("#cards_check").click(function () {
        $(".payment-item").show();
        $("#numbercard").val($('#card_number').val());
    });

    $("#hours1").click(function () {
        $("#selectdays").show();
    });
    $("#hours2").click(function () {
        $("#selectdays").hide();
    });
    $("#hours3").click(function () {
        $("#selectdays").hide();
    });
    $("#hours4").click(function () {
        $("#selectdays").hide();
    });
    $("#hours5").click(function () {
        $("#selectdays").hide();
    });
    
    $("#viewmore1").click(function() {
        $("#middle1").addClass("intro");
        $("#viewless1").show();
        $("#viewmore1").hide();
    });        
    $("#viewless1").click(function() {
        $("#middle1").removeClass("intro");
        $("#viewless1").hide();
        $("#viewmore1").show();
    });        
    $("#viewmore2").click(function() {
        $("#middle2").addClass("intro1");
        $("#viewless2").show();
        $("#viewmore2").hide();
    });        
    $("#viewless2").click(function() {
        $("#middle2").removeClass("intro1");
        $("#viewless2").hide();
        $("#viewmore2").show();
    });
    $("#viewmore3").click(function() {
        $("#middle3").addClass("intro2");
        $("#viewless3").show();
        $("#viewmore3").hide();
    });        
    $("#viewless3").click(function() {
        $("#middle3").removeClass("intro2");
        $("#viewless3").hide();
        $("#viewmore3").show();
    });

    /*** 6 - 4 - 2021 ***/

    $("#card_1").click(function () {
        $(".cardpayment-logo .visa_card").show();
    });

    $("#card_2").click(function () {
        $(".cardpayment-logo .master_card").show();
    });

    $("#card_1").click(function () {
        $(".cardpayment-logo .master_card").hide();
    });

    $("#card_2").click(function () {
        $(".cardpayment-logo .visa_card").hide();
    });

    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });

   /* $(".percentageckeck").click(function () {
        $(".salestaxpercentage").toggleClass("show");
    });

    $(".percentageckeck1").click(function () {
        $(".duestaxpercentage").toggleClass("show1");
    });*/
	
	$('.percentageckeck').click(function() {
		//console.log($(this).find('input[type=checkbox]').val());
        if ($(this).find('input[type=checkbox]').val() == 'salestax') {
           // $('#salestaxpercentage').toggle();
		   if($("#salestax").prop('checked') == true)
		   	{
				$('#salestaxpercentage').show();
			}
			else
			{
				$('#salestaxpercentage').hide();
			}
            
        }
        if ($(this).find('input[type=checkbox]').val() == 'duestax') {
           // $('#duestaxpercentage').toggle();
            if($("#duestax").prop('checked') == true)
		   	{
				$('#duestaxpercentage').show();
			}
			else
			{
				$('#duestaxpercentage').hide();
			}
        }
    });
	
	$('.c_percentageckeck').click(function() {
		//console.log($(this).find('input[type=checkbox]').val());
        if ($(this).find('input[type=checkbox]').val() == 'csalestax') {
           // $('#salestaxpercentage').toggle();
		   if($("#c_salestax").prop('checked') == true)
		   	{
				$('#c_salestaxpercentage').show();
			}
			else
			{
				$('#c_salestaxpercentage').hide();
			}
            
        }
        if ($(this).find('input[type=checkbox]').val() == 'cduestax') {
           // $('#duestaxpercentage').toggle();
            if($("#c_duestax").prop('checked') == true)
		   	{
				$('#c_duestaxpercentage').show();
			}
			else
			{
				$('#c_duestaxpercentage').hide();
			}
        }
    });

    $(".terms-check1 input").click(function () {
        $("#termfaq").toggle();
    });

    $(".terms-check2 input").click(function () {
        $("#contractterms").toggle();
    });

    $(".terms-check3 input").click(function () {
        $("#liability").toggle();
    });

    $(".terms-check4 input").click(function () {
        $("#covid").toggle();
    });

    
    $(".add-another-session").click(function() {        
        var str = '<div class="col-md-12 pricing-details">' +
            '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>' +
            '<div class="pricing-details-block recuring"><label for="">Recuring Payment</label><input type="checkbox" name="" id=""></div><div class="pricing-details-block"><label for="">Numbers of Sessions</label><input type="text" name="" id="" class="form-control"></div><div class="pricing-details-block price-b"><label for="">Price</label><span class="dollar-span" style="display: block;">$</span><input type="text" name="" id="" class="form-control"></div><div class="pricing-details-block dis-cate"><label for="">Discount Category</label><select name="discount_frm" id="discount_frm1" multiple><option hidden>Select Value</option><option value="">Free</option><option value="">Consultation</option><option value="">Assessment</option><option value="">Trial</option><option value="">Gift</option><option value="">Student </option><option value="">Military</option><option value="">Black Friday</option><option value="">Holiday</option><option value="">Cyber Monday</option><option value="">New Years </option><option value="">Summer</option><option value="">Winter</option><option value="">Fall</option><option value="">Spring</option><option value="">Online</option></select></div><div class="pricing-details-block"><label for="">Discount Type</label><select name="discounttype" class="form-control" id="discount_type"><option value="">$ Dollar</option><option value="">% Percentage</option></select></div><div class="pricing-details-block"><label for="">Discount</label><input type="text" name="" id="" class="form-control" placeholder="$100"></div><div class="pricing-details-block earnings"><label for="">Your Estimated Earnings <a href="#" class="custom_que">?</a></label><input type="text" name="" id="" class="form-control"></div><div class="pricing-details-block"><label for="">Set Number</label><input type="text" name="" id="" class="form-control" placeholder="(ex,1,2,3,etc.)"></div><div class="pricing-details-block1"><p>Set Expiration</p><div class="pricing-dblock"><label for="">Duration</label><select name="duration" id="duration" class="form-control"><option hidden>Select Value</option><option value="">30 Minutes</option><option value="">45 Minutes</option><option value="">1 Hours</option><option value="">2 Hours</option><option value="">3 Hours</option><option value="">4 Hours</option><option value="">5 Hours</option><option value="">6 Hours</option><option value="">7 Hours</option><option value="">8 Hours</option><option value="">9 Hours</option><option value="">10 Hours</option><option value="">1 Day</option><option value="">2 Days</option><option value="">3 Days</option><option value="">4 Days</option><option value="">5 Days</option><option value="">6 Days</option><option value="">7 Days</option><option value="">8 Days</option><option value="">9 Days</option><option value="">10 Days</option></select></div><div class="pricing-dblock"><label for="">After</label><select name="after_frm" id="after_frm1" multiple><option hidden>Select Value</option><option value="">1</option><option value="">2</option><option value="">3</option><option value="">4</option><option value="">5</option></select></div></div></div>';

        $(".pricing_details_all").append(str);
        
        var p = new SlimSelect({
            select: '#discount_frm1'
        });
        var p = new SlimSelect({
            select: '#after_frm1'
        });
        
    });
    
    $(".add-another-session-c").click(function() {        

        var str = '<div class="col-md-12 pricing-details">' +
            '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>' +
            '<div class="pricing-details-block recuring"><label for="">Recuring Payment</label><input type="checkbox" name="" id=""></div><div class="pricing-details-block"><label for="">Numbers of Sessions</label><input type="text" name="" id="" class="form-control"></div><div class="pricing-details-block price-b"><label for="">Price</label><span class="dollar-span" style="display: block;">$</span><input type="text" name="" id="" class="form-control"></div><div class="pricing-details-block dis-cate"><label for="">Discount Category</label><select name="discount_frm" id="c_discount_frm1" multiple><option hidden>Select Value</option><option value="">Free</option><option value="">Consultation</option><option value="">Assessment</option><option value="">Trial</option><option value="">Gift</option><option value="">Student </option><option value="">Military</option><option value="">Black Friday</option><option value="">Holiday</option><option value="">Cyber Monday</option><option value="">New Years </option><option value="">Summer</option><option value="">Winter</option><option value="">Fall</option><option value="">Spring</option><option value="">Online</option></select></div><div class="pricing-details-block"><label for="">Discount Type</label><select name="discounttype" class="form-control" id="discount_type"><option value="">$ Dollar</option><option value="">% Percentage</option></select></div><div class="pricing-details-block"><label for="">Discount</label><input type="text" name="" id="" class="form-control" placeholder="$100"></div><div class="pricing-details-block earnings"><label for="">Your Estimated Earnings <a href="#" class="custom_que">?</a></label><input type="text" name="" id="" class="form-control"></div><div class="pricing-details-block"><label for="">Set Number</label><input type="text" name="" id="" class="form-control" placeholder="(ex,1,2,3,etc.)"></div><div class="pricing-details-block1"><p>Set Expiration</p><div class="pricing-dblock"><label for="">Duration</label><select name="duration" id="duration" class="form-control"><option hidden>Select Value</option><option value="">30 Minutes</option><option value="">45 Minutes</option><option value="">1 Hours</option><option value="">2 Hours</option><option value="">3 Hours</option><option value="">4 Hours</option><option value="">5 Hours</option><option value="">6 Hours</option><option value="">7 Hours</option><option value="">8 Hours</option><option value="">9 Hours</option><option value="">10 Hours</option><option value="">1 Day</option><option value="">2 Days</option><option value="">3 Days</option><option value="">4 Days</option><option value="">5 Days</option><option value="">6 Days</option><option value="">7 Days</option><option value="">8 Days</option><option value="">9 Days</option><option value="">10 Days</option></select></div><div class="pricing-dblock"><label for="">After</label><select name="after_frm" id="c_after_frm1" multiple><option hidden>Select Value</option><option value="">1</option><option value="">2</option><option value="">3</option><option value="">4</option><option value="">5</option></select></div></div></div>';

        $(".pricing_details_all-c").append(str);
        
        var p = new SlimSelect({
            select: '#c_discount_frm1'
        });
        var p = new SlimSelect({
            select: '#c_after_frm1'
        });
        
    });
    
    $("#additem1").click(function() {        
        var str = '<div class="included-block1" style="margin-top: 10px;">' +
            '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>' +
            '<label>You can Provide transportation and pick up from hotels etc., food and drinks, special equipment, video and photography services, or anything else special to make your guests comfortable..</label><select name="frm_exe1" class="exeperience_se1" id="exeperience_se1" multiple><option>Safety & Protective Gear</option><option>Activity Equipment</option><option>Breakfast</option><option>Lunch</option><option>Dinner</option><option>Snacks</option><option>Drinks (tea, coffee, soda, bottled water, etc.) </option><option>Alcohol (beer, champagne, wine, mixed drink etc.)</option><option>Transportation</option><option>Insurance Coverage</option><option>Entrance Fees</option><option>Airfare</option><option>Taxes</option><option>Professional Guide</option><option>Guide Gratuity</option><option>Accommodations</option><option>Video</option><option>Photography</option><option>Fully Narrated</option><option>Historic landmarks</option><option>Rest period</option><option>Typical souvenir</option></select></div>';

        $(".wahts-b").append(str);
        
        var p = new SlimSelect({
            select: '.exeperience_se1'
        });
        
    });
    
    $("#additem2").click(function() {        
        var str = '<div class="included-block2" style="margin-top: 10px;">' +
            '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>' +
            '<label>List the items or services that are not included with this experience. i.e. no food or drinks, no equipment, no insurance, etc.</label><select name="frm_exe1" class="exeperience_se2" id="exeperience_se2" multiple><option>Safety & Protective Gear</option><option>Activity Equipment</option><option>Breakfast</option><option>Lunch</option><option>Dinner</option><option>Snacks</option><option>Drinks (tea, coffee, soda, bottled water, etc.) </option><option>Alcohol (beer, champagne, wine, mixed drink etc.)</option><option>Transportation</option><option>Insurance Coverage</option><option>Entrance Fees</option><option>Airfare</option><option>Taxes</option><option>Professional Guide</option><option>Guide Gratuity</option><option>Accommodations</option><option>Video</option><option>Photography</option><option>Fully Narrated</option><option>Historic landmarks</option><option>Rest period</option><option>Typical souvenir</option></select></div>';

        $(".wahts_not").append(str);
        
        var p = new SlimSelect({
            select: '.exeperience_se2'
        });
        
    });
    
    $("#additem3").click(function() {        
        var str = '<div class="included-block3" style="margin-top: 10px;">' +
            '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>' +
            '<label>If guests need anything in order to enjoy your exeperience, this is the place to tell them. This list will be emailed to guests when they book exeperience to help them prepare. Be as detailed as possible and add each item individually.</label><select name="frm_exe1" class="exeperience_se3" id="exeperience_se3" multiple><option>Safety & Protective Gear</option><option>Activity Equipment</option><option>Breakfast</option><option>Lunch</option><option>Dinner</option><option>Snacks</option><option>Drinks (tea, coffee, soda, bottled water, etc.) </option><option>Alcohol (beer, champagne, wine, mixed drink etc.)</option><option>Transportation</option><option>Insurance Coverage</option><option>Entrance Fees</option><option>Airfare</option><option>Taxes</option><option>Professional Guide</option><option>Guide Gratuity</option><option>Accommodations</option><option>Video</option><option>Photography</option><option>Fully Narrated</option><option>Historic landmarks</option><option>Rest period</option><option>Typical souvenir</option></select></div>';

        $(".what_guest").append(str);
        
        var p = new SlimSelect({
            select: '.exeperience_se3'
        });
        
    });
    
    
    $("#addday1").click(function() {        
        var str = '<div class="day-block" style="margin-top: 15px;">' +
            '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>' +
            '<div class="imgUp"><label for="">Day-2</label><div class="imagePreview"></div><label class="img-tab-btn">Upload Image<input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;"></label></div><div class="giveblock"><input type="text" name="" id="" class="form-control" placeholder="Give a heading for this day."><textarea name="" id="" cols="30" rows="6" class="form-control" placeholder="Give a description for this day."></textarea></div></div>';

        $(".days_block").append(str);
        
    });
    
	
	/*$('input[type="checkbox"]').click(function() {
		if($(this).attr('id') == 'checkbox1') {
			$(".sunday_start").toggle();
		}
	});
	$('input[type="checkbox"]').click(function() {
		if($(this).attr('id') == 'checkbox2') {
			$(".monday_start").toggle();
		}
	});
	$('input[type="checkbox"]').click(function() {
		if($(this).attr('id') == 'checkbox3') {
			$(".tuesday_start").toggle();
		}
	});
	$('input[type="checkbox"]').click(function() {
		if($(this).attr('id') == 'checkbox4') {
			$(".wednesday_start").toggle();
		}
	});
	$('input[type="checkbox"]').click(function() {
		if($(this).attr('id') == 'checkbox5') {
			$(".thrusday_start").toggle();
		}
	});
	$('input[type="checkbox"]').click(function() {
		if($(this).attr('id') == 'checkbox6') {
			$(".friday_start").toggle();
		}
	});
	$('input[type="checkbox"]').click(function() {
		if($(this).attr('id') == 'checkbox7') {
			$(".saturday_start").toggle();
		}
	});*/
	
	/*$("input[name='radio-group']").change(function(){
		var servicetype=$("input[name='radio-group']:checked").val();
		if(servicetype=='classes')
		{
			$(".location_div").hide();
		}
		if(servicetype=='individual')
		{
			$(".location_div").show();
		}
		if(servicetype=='experience')
		{
			$(".location_div").show();
		}
		
	});*/
	
	/*$('#frm_class_meets').change(function() {
		//console.log($("#startingpicker").val())
		if ($("#frm_class_meets").val() == 'Weekly') 
		{
			$(".schedule_until_box").show()
			if ($("#startingpicker").val() != '') 
			{
				
				$("#sunbox").show();
				$("#monbox").show();
				$("#tuebox").show();
				$("#wedbox").show();
				$("#thubox").show();
				$("#fribox").show();
				$("#satbox").show();
				$("#checkbox1").prop("checked", false);
				$("#checkbox2").prop("checked", false);
				$("#checkbox3").prop("checked", false);
				$("#checkbox4").prop("checked", false);
				$("#checkbox5").prop("checked", false);
				$("#checkbox6").prop("checked", false);
				$("#checkbox7").prop("checked", false);
				if ($("#startingpicker").val() != '') 
				{
					var date = $('#startingpicker').datepicker('getDate');
                    var day = $.datepicker.formatDate('DD', date);
														
					if (day == 'Monday') {
						$("#checkbox2").prop("checked", true);
						$(".monday_start").show();
						$(".tuesday_start").hide();
						$(".wednesday_start").hide();
						$(".thrusday_start").hide();
						$(".friday_start").hide();
						$(".saturday_start").hide();
						$(".sunday_start").hide();
					}
					if (day == 'Tuesday') {
						$("#checkbox3").prop("checked", true);
						$(".monday_start").hide();
						$(".tuesday_start").show();
						$(".wednesday_start").hide();
						$(".thrusday_start").hide();
						$(".friday_start").hide();
						$(".saturday_start").hide();
						$(".sunday_start").hide();
					}
					if (day == 'Wednesday') {
						$("#checkbox4").prop("checked", true);
						$(".monday_start").hide();
						$(".tuesday_start").hide();
						$(".wednesday_start").show();
						$(".thrusday_start").hide();
						$(".friday_start").hide();
						$(".saturday_start").hide();
						$(".sunday_start").hide();
					}
					if (day == 'Thursday') {
						$("#checkbox5").prop("checked", true);
						$(".monday_start").hide();
						$(".tuesday_start").hide();
						$(".wednesday_start").hide();
						$(".thrusday_start").show();
						$(".friday_start").hide();
						$(".saturday_start").hide();
						$(".sunday_start").hide();
					}
					if (day == 'Friday') {
						$("#checkbox6").prop("checked", true);
						$(".monday_start").hide();
						$(".tuesday_start").hide();
						$(".wednesday_start").hide();
						$(".thrusday_start").hide();
						$(".friday_start").show();
						$(".saturday_start").hide();
						$(".sunday_start").hide();
					}
					if (day == 'Saturday') {
						$("#checkbox7").prop("checked", true);
						$(".monday_start").hide();
						$(".tuesday_start").hide();
						$(".wednesday_start").hide();
						$(".thrusday_start").hide();
						$(".friday_start").hide();
						$(".saturday_start").show();
						$(".sunday_start").hide();
					}
					if (day == 'Sunday') {
						$("#checkbox1").prop("checked", true);
						$(".monday_start").hide();
						$(".tuesday_start").hide();
						$(".wednesday_start").hide();
						$(".thrusday_start").hide();
						$(".friday_start").hide();
						$(".saturday_start").hide();
						$(".sunday_start").show();
					}
				}
				
			}
		}
		else 
		{
			$(".schedule_until_box").hide()
			if ($("#startingpicker").val() != '') 
			{
				var date = $('#startingpicker').datepicker('getDate');
                var day = $.datepicker.formatDate('DD', date);
				if (day == 'Monday') {
					$("#sunbox").hide();
					$("#monbox").show();
					$("#tuebox").hide();
					$("#wedbox").hide();
					$("#thubox").hide();
					$("#fribox").hide();
					$("#satbox").hide();
					$("#checkbox2").prop("checked", true);
					$(".monday_start").show();
					$(".tuesday_start").hide();
					$(".wednesday_start").hide();
					$(".thrusday_start").hide();
					$(".friday_start").hide();
					$(".saturday_start").hide();
					$(".sunday_start").hide();
				}
				if (day == 'Tuesday') {
					$("#sunbox").hide();
					$("#monbox").hide();
					$("#tuebox").show();
					$("#wedbox").hide();
					$("#thubox").hide();
					$("#fribox").hide();
					$("#satbox").hide();
					$("#checkbox3").prop("checked", true);
					$(".tuesday_start").show();
					$(".monday_start").hide();
					$(".wednesday_start").hide();
					$(".thrusday_start").hide();
					$(".friday_start").hide();
					$(".saturday_start").hide();
					$(".sunday_start").hide();
				}
				if (day == 'Wednesday') {
					$("#sunbox").hide();
					$("#monbox").hide();
					$("#tuebox").hide();
					$("#wedbox").show();
					$("#thubox").hide();
					$("#fribox").hide();
					$("#satbox").hide();
					$("#checkbox4").prop("checked", true);
					$(".wednesday_start").show();
					$(".monday_start").hide();
					$(".tuesday_start").hide();
					$(".thrusday_start").hide();
					$(".friday_start").hide();
					$(".saturday_start").hide();
					$(".sunday_start").hide();
				}
				if (day == 'Thursday') {
					$("#sunbox").hide();
					$("#monbox").hide();
					$("#tuebox").hide();
					$("#wedbox").hide();
					$("#thubox").show();
					$("#fribox").hide();
					$("#satbox").hide();
					$("#checkbox5").prop("checked", true);
					$(".thrusday_start").show();
					$(".monday_start").hide();
					$(".tuesday_start").hide();
					$(".wednesday_start").hide();
					$(".friday_start").hide();
					$(".saturday_start").hide();
					$(".sunday_start").hide();
				}
				if (day == 'Friday') {
					$("#sunbox").hide();
					$("#monbox").hide();
					$("#tuebox").hide();
					$("#wedbox").hide();
					$("#thubox").hide();
					$("#fribox").show();
					$("#satbox").hide();
					$("#checkbox6").prop("checked", true);
					$(".friday_start").show();
					$(".monday_start").hide();
					$(".tuesday_start").hide();
					$(".wednesday_start").hide();
					$(".thrusday_start").hide();
					$(".saturday_start").hide();
					$(".sunday_start").hide();
				}
				if (day == 'Saturday') {
					$("#sunbox").hide();
					$("#monbox").hide();
					$("#tuebox").hide();
					$("#wedbox").hide();
					$("#thubox").hide();
					$("#fribox").hide();
					$("#satbox").show();
					$("#checkbox7").prop("checked", true);
					$(".saturday_start").show();
					$(".monday_start").hide();
					$(".tuesday_start").hide();
					$(".wednesday_start").hide();
					$(".thrusday_start").hide();
					$(".friday_start").hide();
					$(".sunday_start").hide();
				}
				if (day == 'Sunday') {
					$("#sunbox").show();
					$("#monbox").hide();
					$("#tuebox").hide();
					$("#wedbox").hide();
					$("#thubox").hide();
					$("#fribox").hide();
					$("#satbox").hide();
					$("#checkbox1").prop("checked", true);
					$(".sunday_start").show();
					$(".monday_start").hide();
					$(".tuesday_start").hide();
					$(".wednesday_start").hide();
					$(".thrusday_start").hide();
					$(".friday_start").hide();
					$(".saturday_start").hide();
				}
			}
		}
	});*/
	
	$(".day-time-div-main").on('click', '.dys', function() {
        console.log($(this).attr('class'))
        if ($(this).attr('class').includes("day_circle_fill")) {
			
			//console.log('11');
            $(this).removeClass("day_circle_fill")
            if ($(this).attr('class').includes('Sunday')) {
				//console.log($(this).attr('class'))
                $(this).parent().parent().children().children(".sunday_start").hide()
                $(this).parent().parent().children().children(".sunday_start").children().children().children($("input[name='hours[sunday_start]']")).val('')
                $(this).parent().parent().children().children(".sunday_start").children().children().children($("input[name='hours[sunday_end]']")).val('')

            }
            if ($(this).attr('class').includes('Monday')) {
                $(this).parent().parent().children().children(".monday_start").hide()
                $(this).parent().parent().children().children(".monday_start").children().children().children($("input[name='hours[monday_start]']")).val('')
                $(this).parent().parent().children().children(".monday_start").children().children().children($("input[name='hours[monday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Tuesday')) {
                $(this).parent().parent().children().children(".tuesday_start").hide()
                $(this).parent().parent().children().children(".tuesday_start").children().children().children($("input[name='hours[tuesday_start]']")).val('')
                $(this).parent().parent().children().children(".tuesday_start").children().children().children($("input[name='hours[tuesday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Wednesday')) {
                $(this).parent().parent().children().children(".wednesday_start").hide()
                $(this).parent().parent().children().children(".wednesday_start").children().children().children($("input[name='hours[wednesday_start]']")).val('')
                $(this).parent().parent().children().children(".wednesday_start").children().children().children($("input[name='hours[wednesday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Thrusday')) {
                $(this).parent().parent().children().children(".thrusday_start").hide()
                $(this).parent().parent().children().children(".thrusday_start").children().children().children($("input[name='hours[thrusday_start]']")).val('')
                $(this).parent().parent().children().children(".thrusday_start").children().children().children($("input[name='hours[thrusday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Friday')) {
                $(this).parent().parent().children().children(".friday_start").hide()
                $(this).parent().parent().children().children(".friday_start").children().children().children($("input[name='hours[friday_start]']")).val('')
                $(this).parent().parent().children().children(".friday_start").children().children().children($("input[name='hours[friday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Saturday')) {
                $(this).parent().parent().children().children(".saturday_start").hide()
                $(this).parent().parent().children().children(".saturday_start").children().children().children($("input[name='hours[saturday_start]']")).val('')
                $(this).parent().parent().children().children(".saturday_start").children().children().children($("input[name='hours[saturday_end]']")).val('')
            }
        } else {
            $(this).addClass("day_circle_fill")
            if ($(this).attr('class').includes('Sunday'))
			{  console.log('aa');
			console.log($(this).parent().parent().children('class'));
                $(this).parent().parent().children().children(".sunday_start").show()
			}
			if ($(this).attr('class').includes('Monday'))
                $(this).parent().parent().children().children(".monday_start").show()
            if ($(this).attr('class').includes('Tuesday'))
                $(this).parent().parent().children().children(".tuesday_start").show()
            if ($(this).attr('class').includes('Wednesday'))
                $(this).parent().parent().children().children(".wednesday_start").show()
            if ($(this).attr('class').includes('Thrusday'))
                $(this).parent().parent().children().children(".thrusday_start").show()
            if ($(this).attr('class').includes('Friday'))
                $(this).parent().parent().children().children(".friday_start").show()
            if ($(this).attr('class').includes('Saturday'))
                $(this).parent().parent().children().children(".saturday_start").show()
        }
        // if($(this).attr('class').includes('Sunday'))
        //         $(this).parent().parent().children().children(".sunday_start").show()
        //     if($(this).attr('class').includes('Monday'))
        //         $(this).parent().parent().children().children(".monday_start").show()
        //     if($(this).attr('class').includes('Tuesday'))
        //         $(this).parent().parent().children().children(".tuesday_start").show()
        //     if($(this).attr('class').includes('Wednesday'))
        //         $(this).parent().parent().children().children(".wednesday_start").show()
        //     if($(this).attr('class').includes('Thrusday'))
        //         $(this).parent().parent().children().children(".thrusday_start").show()
        //     if($(this).attr('class').includes('Friday'))
        //         $(this).parent().parent().children().children(".friday_start").show()
        //     if($(this).attr('class').includes('Saturday'))
        //         $(this).parent().parent().children().children(".saturday_start").show()
    });
	
	var i = 0
    $(".add-another-time").click(function() {
        i = i + 1;
        console.log("iii " + i);
        var str = '<div class="day-time-div1">' +
            '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>' +
            '<div class="row" style="justify-content: center;">' +
            '<div class="col-sm-1 timezone-round day_circle Sunday dys">' +
            '<p>Su</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle Monday dys">' +
            '<p>Mo</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle Tuesday dys">' +
            '<p>Tu</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle Wednesday dys">' +
            '<p>We</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle Thrusday dys">' +
            '<p>Th</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle Friday dys">' +
            '<p>Fr</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle Saturday dys">' +
            '<p>Sa</p>' +
            '</div>' +
            '</div>' +
            '<div class="wrapperow1">' +
			'<div class="col-md-12 sunday_start" style="display:none;">'+
			'<div class="col-md-12">Sunday Time</div>'+
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="fromtime-sun form-control" name="hours[sunday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				  
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="totime-sun form-control" name="hours[sunday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
					  
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="sunduration' + i + '" id="sunduration' + i + '" class="form-control">'+
			'<option>30 Minutes</option>'+
			'<option>45 Minutes</option>'+
			'<option>1 Hours</option>'+
			'<option>2 Hours</option>'+
			'<option>3 Hours</option>'+
			'<option>4 Hours</option>'+
			'<option>5 Hours</option>'+
			'<option>6 Hours</option>'+
			'<option>7 Hours</option>'+
			'<option>8 Hours</option>'+
			'<option>9 Hours</option>'+
			'<option>10 Hours</option>'+
			'<option>1 Day</option>'+
			'<option>2 Days</option>'+
			'<option>3 Days</option>'+
			'<option>4 Days</option>'+
			'<option>5 Days</option>'+
			'<option>6 Days</option>'+
			'<option>7 Days</option>'+
			'<option>8 Days</option>'+
			'<option>9 Days</option>'+
			'<option>10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+
			  
			'<div class="col-md-12 monday_start" style="display:none;">'+
			'<div class="col-md-12">Monday Time</div>'+
					  
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="fromtime-mon form-control" name="hours[monday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				  
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="totime-mon form-control" name="hours[monday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
					  
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="monduration' + i + '" id="monduration' + i + '" class="form-control">'+
			'<option>30 Minutes</option>'+
			'<option>45 Minutes</option>'+
			'<option>1 Hours</option>'+
			'<option>2 Hours</option>'+
			'<option>3 Hours</option>'+
			'<option>4 Hours</option>'+
			'<option>5 Hours</option>'+
			'<option>6 Hours</option>'+
			'<option>7 Hours</option>'+
			'<option>8 Hours</option>'+
			'<option>9 Hours</option>'+
			'<option>10 Hours</option>'+
			'<option>1 Day</option>'+
			'<option>2 Days</option>'+
			'<option>3 Days</option>'+
			'<option>4 Days</option>'+
			'<option>5 Days</option>'+
			'<option>6 Days</option>'+
			'<option>7 Days</option>'+
			'<option>8 Days</option>'+
			'<option>9 Days</option>'+
			'<option>10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+
			  
			'<div class="col-md-12 tuesday_start" style="display:none;">'+
															
			'<div class="col-md-12">Tuesday Time</div>'+
					
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="fromtime-tue form-control" name="hours[tuesday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="totime-tue form-control" name="hours[tuesday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
					
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="tuesduration' + i + '" id="tuesduration' + i + '" class="form-control">'+
			'<option>30 Minutes</option>'+
			'<option>45 Minutes</option>'+
			'<option>1 Hours</option>'+
			'<option>2 Hours</option>'+
			'<option>3 Hours</option>'+
			'<option>4 Hours</option>'+
			'<option>5 Hours</option>'+
			'<option>6 Hours</option>'+
			'<option>7 Hours</option>'+
			'<option>8 Hours</option>'+
			'<option>9 Hours</option>'+
			'<option>10 Hours</option>'+
			'<option>1 Day</option>'+
			'<option>2 Days</option>'+
			'<option>3 Days</option>'+
			'<option>4 Days</option>'+
			'<option>5 Days</option>'+
			'<option>6 Days</option>'+
			'<option>7 Days</option>'+
			'<option>8 Days</option>'+
			'<option>9 Days</option>'+
			'<option>10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+
			
			'<div class="col-md-12 wednesday_start" style="display:none;">'+
														
			'<div class="col-md-12">Wednesday Time</div>'+
					
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="fromtime-wed form-control" name="hours[wednesday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="totime-wed form-control" name="hours[wednesday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
					
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="wedduration' + i + '" id="wedduration' + i + '" class="form-control">'+
			'<option>30 Minutes</option>'+
			'<option>45 Minutes</option>'+
			'<option>1 Hours</option>'+
			'<option>2 Hours</option>'+
			'<option>3 Hours</option>'+
			'<option>4 Hours</option>'+
			'<option>5 Hours</option>'+
			'<option>6 Hours</option>'+
			'<option>7 Hours</option>'+
			'<option>8 Hours</option>'+
			'<option>9 Hours</option>'+
			'<option>10 Hours</option>'+
			'<option>1 Day</option>'+
			'<option>2 Days</option>'+
			'<option>3 Days</option>'+
			'<option>4 Days</option>'+
			'<option>5 Days</option>'+
			'<option>6 Days</option>'+
			'<option>7 Days</option>'+
			'<option>8 Days</option>'+
			'<option>9 Days</option>'+
			'<option>10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+
			
			'<div class="col-md-12 thrusday_start" style="display:none;">'+
															
			'<div class="col-md-12">Thursday Time</div>'+
				  
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="fromtime-thu form-control" name="hours[thrusday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
			  
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="totime-thu form-control" name="hours[thrusday_end]" autocomplete="off" style=" width:100%" >'+
			'</div>'+
				  
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="thuduration' + i + '" id="thuduration' + i + '" class="form-control">'+
			'<option>30 Minutes</option>'+
			'<option>45 Minutes</option>'+
			'<option>1 Hours</option>'+
			'<option>2 Hours</option>'+
			'<option>3 Hours</option>'+
			'<option>4 Hours</option>'+
			'<option>5 Hours</option>'+
			'<option>6 Hours</option>'+
			'<option>7 Hours</option>'+
			'<option>8 Hours</option>'+
			'<option>9 Hours</option>'+
			'<option>10 Hours</option>'+
			'<option>1 Day</option>'+
			'<option>2 Days</option>'+
			'<option>3 Days</option>'+
			'<option>4 Days</option>'+
			'<option>5 Days</option>'+
			'<option>6 Days</option>'+
			'<option>7 Days</option>'+
			'<option>8 Days</option>'+
			'<option>9 Days</option>'+
			'<option>10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+
			
            '<div class="col-md-12 friday_start" style="display:none;">'+
															
			'<div class="col-md-12">Friday Time</div>'+
				
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="fromtime-fri form-control" name="hours[friday_start]" autocomplete="off" style=" width:100%" >'+
			'</div>'+
			
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="totime-fri form-control" name="hours[friday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="friduration' + i + '" id="friduration' + i + '" class="form-control">'+
			'<option>30 Minutes</option>'+
			'<option>45 Minutes</option>'+
			'<option>1 Hours</option>'+
			'<option>2 Hours</option>'+
			'<option>3 Hours</option>'+
			'<option>4 Hours</option>'+
			'<option>5 Hours</option>'+
			'<option>6 Hours</option>'+
			'<option>7 Hours</option>'+
			'<option>8 Hours</option>'+
			'<option>9 Hours</option>'+
			'<option>10 Hours</option>'+
			'<option>1 Day</option>'+
			'<option>2 Days</option>'+
			'<option>3 Days</option>'+
			'<option>4 Days</option>'+
			'<option>5 Days</option>'+
			'<option>6 Days</option>'+
			'<option>7 Days</option>'+
			'<option>8 Days</option>'+
			'<option>9 Days</option>'+
			'<option>10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+
			
            '<div class="col-md-12 saturday_start" style="display:none;">'+
															
			'<div class="col-md-12">Saturday Time</div>'+
			  
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="fromtime-sat form-control" name="hours[saturday_start]" autocomplete="off" style=" width:100%" >'+
			'</div>'+
		  
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="totime-sat form-control" name="hours[saturday_end]" autocomplete="off" style=" width:100%" >'+
			'</div>'+
			  
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="satduration' + i + '" id="satduration' + i + '" class="form-control">'+
			'<option>30 Minutes</option>'+
			'<option>45 Minutes</option>'+
			'<option>1 Hours</option>'+
			'<option>2 Hours</option>'+
			'<option>3 Hours</option>'+
			'<option>4 Hours</option>'+
			'<option>5 Hours</option>'+
			'<option>6 Hours</option>'+
			'<option>7 Hours</option>'+
			'<option>8 Hours</option>'+
			'<option>9 Hours</option>'+
			'<option>10 Hours</option>'+
			'<option>1 Day</option>'+
			'<option>2 Days</option>'+
			'<option>3 Days</option>'+
			'<option>4 Days</option>'+
			'<option>5 Days</option>'+
			'<option>6 Days</option>'+
			'<option>7 Days</option>'+
			'<option>8 Days</option>'+
			'<option>9 Days</option>'+
			'<option>10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+
		  
			'</div>'+
            '</div>';
		
        jQuery(".day-time-div-main").append(str);
		$(".fromtime-sun, .totime-sun").datetimepicker({ datepicker:false, format: 'H:i' }); 
		$(".fromtime-mon, .totime-mon").datetimepicker({ datepicker:false, format: 'H:i' }); 
		$(".fromtime-tue, .totime-tue").datetimepicker({ datepicker:false, format: 'H:i' }); 
		$(".fromtime-wed, .totime-wed").datetimepicker({ datepicker:false, format: 'H:i' }); 
		$(".fromtime-thu, .totime-thu").datetimepicker({ datepicker:false, format: 'H:i' }); 
		$(".fromtime-fri, .totime-fri").datetimepicker({ datepicker:false, format: 'H:i' }); 
		$(".fromtime-sat, .totime-sat").datetimepicker({ datepicker:false, format: 'H:i' }); 
        setTimeout(function() { 
            myDayFunction();
            //start
			/*console.log('day-time-div-main');
			var day = moment($('#startingpicker').val(), 'MM-DD-YYYY').format('dddd')
			if ($('#frm_class_meets').val() != 'Weekly') { console.log('specific date');
				if (day == 'Monday') {
					$(".Monday").show()
					$(".Monday").addClass('day_circle_fill')
					$(".monday_start").show()
					$(".Sunday").hide()
					$(".Tuesday").hide()
					$(".Wednesday").hide()
					$(".Thrusday").hide()
					$(".Friday").hide()
					$(".Saturday").hide()
				}
				if (day == 'Tuesday') {
					$(".Monday").hide()
					$(".Sunday").hide()
					$(".Tuesday").show()
					$(".Tuesday").addClass('day_circle_fill')
					$(".tuesday_start").show()
					$(".Wednesday").hide()
					$(".Thrusday").hide()
					$(".Friday").hide()
					$(".Saturday").hide()
				}
				if (day == 'Wednesday') {
					$(".Monday").hide()
					$(".Sunday").hide()
					$(".Tuesday").hide()
					$(".Wednesday").show()
					$(".Wednesday").addClass('day_circle_fill')
					$(".wednesday_start").show()
					$(".Thrusday").hide()
					$(".Friday").hide()
					$(".Saturday").hide()
				}
				if (day == 'Thursday') {
					$(".Monday").hide()
					$(".Sunday").hide()
					$(".Tuesday").hide()
					$(".Wednesday").hide()
					$(".Thrusday").show()
					$(".Thrusday").addClass('day_circle_fill')
					$(".thrusday_start").show()
					$(".Friday").hide()
					$(".Saturday").hide()
 				}
				if (day == 'Friday') {
					$(".Monday").hide()
	                $(".Sunday").hide()
	                $(".Tuesday").hide()
	                $(".Wednesday").hide()
	                $(".Thrusday").hide()
	                $(".Friday").show()
	                $(".Friday").addClass('day_circle_fill')
	                $(".friday_start").show()
	                $(".Saturday").hide()
	            }
	            if (day == 'Saturday') {
	                $(".Monday").hide()
	                $(".Sunday").hide()
	                $(".Tuesday").hide()
	                $(".Wednesday").hide()
	                $(".Thrusday").hide()
	                $(".Friday").hide()
	                $(".Saturday").show()
	                $(".Saturday").addClass('day_circle_fill')
	                $(".saturday_start").show()
	            }
	            if (day == 'Sunday') {
	                $(".Monday").hide()
	                $(".Sunday").show()
	                $(".Sunday").addClass('day_circle_fill')
	                $(".sunday_start").show()
		            $(".Tuesday").hide()
			        $(".Wednesday").hide()
	                $(".Thrusday").hide()
	                $(".Friday").hide()
	                $(".Saturday").hide()
	            }
	        } 
			else {
					
				$(".Monday").show()
	            $(".Sunday").show()
	            $(".Tuesday").show()
	            $(".Wednesday").show()
	            $(".Thrusday").show()
	            $(".Friday").show()
	            $(".Saturday").show()
	            if (day == 'Monday') {
	                $(".Monday").show()
	                $(".Monday").addClass('day_circle_fill')
	                $(".monday_start").show()
	            }
	            if (day == 'Tuesday') {
	                $(".Tuesday").show()
	                $(".Tuesday").addClass('day_circle_fill')
	                $(".tuesday_start").show()
	            }
	            if (day == 'Wednesday') {
	                $(".Wednesday").show()
	                $(".Wednesday").addClass('day_circle_fill')
		            $(".wednesday_start").show()
	            }
	            if (day == 'Thursday') {
	                $(".Thrusday").show()
	                $(".Thrusday").addClass('day_circle_fill')
	                $(".thrusday_start").show()
	            }
	            if (day == 'Friday') {
	                $(".Friday").show()
	                $(".Friday").addClass('day_circle_fill')
	                $(".friday_start").show()
	            }
	            if (day == 'Saturday') {
	                $(".Saturday").show()
	                $(".Saturday").addClass('day_circle_fill')
	                $(".saturday_start").show()
	            }
	            if (day == 'Sunday') {
	                $(".Sunday").show()
	                $(".Sunday").addClass('day_circle_fill')
	                $(".sunday_start").show()
	            }
        	}*/
			//end
			
			/*$('.day-time-div-main .timepicker').timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    if ($(this).parent().parent().children(':nth-child(3)').children().val() == '') {
                        $(this).val('')
                        showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select TO time without selecting from time.');
                    }
                }
            });*/
			console.log("con1");
			$('.day-time-div-main .timepicker').timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    if ($(this).parent().parent().children(':nth-child(3)').children().val() == '') {
                        $(this).val('')
                        showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select TO time without selecting from time.');
                    }
                }
            });
            console.log("con2");
			jQuery('.day-time-div-main .sunquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
					console.log('sunday_start_arr x');
                    /*var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    console.log(sunday_start_arr)
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".sunquicktimepicker" + i).val('')
                        }
                    }, 100)*/
                }
            });
			
			console.log("con3");
            jQuery('.day-time-div-main .tuesquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[tuesday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".tuesquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
			console.log("con4");
            jQuery('.day-time-div-main .wedquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[wednesday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".wedquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
			console.log("con5");
            jQuery('.day-time-div-main .thrusquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[thrusday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".thrusquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
			console.log("con6");
            jQuery('.day-time-div-main .friquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[friday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".friquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
			console.log("con7");
            jQuery('.day-time-div-main .satquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    var sunday_start_arr = $('input[name="hours[saturday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr)
                        console.log(g)
                        if (g == true) {
                            console.log(i)
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".satquicktimepicker" + i).val('')
                        }
                    }, 100)
                }
            });
			jQuery('.day-time-div-main .monquicktimepicker' + i).timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
					console.log('change');
					console.log('monday--');
                    var sunday_start_arr = $('input[name="hours[monday_start]"]').map(function() {
                        return this.value; // $(this).val()
                    }).get();
                    setTimeout(function() {
                        var g = hasDuplicates(sunday_start_arr);
                        console.log(g);
                        if (g == true) {
                            console.log(i);
                            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                            $(".monquicktimepicker" + i).val('');
                        }
                    }, 100)
                }
            });
        }, 100)
		
    });
	
	
	
	$("#frm_schedule_until").change(function() {
        if ($('#startingpicker').val() != '') {
			var res=$('#frm_schedule_until').val().split(' ');
			var incmonth=res[0];
			var date = $('#startingpicker').datepicker('getDate');
			var second_date = new Date(date);
			second_date.setMonth(second_date.getMonth()+2);
			//second_date.setMonth(second_date.getMonth()+incmonth);
			console.log(second_date);
			var second_date1 = new Date(second_date),
			mnth = ("0" + (second_date1.getMonth() + 1)).slice(-2),
			day = ("0" + second_date1.getDate()).slice(-2);
			var fulldate= [mnth,day,second_date1.getFullYear()].join("/");
			
			$("#end_date").val(fulldate);
            //var new_date = moment($('#startingpicker').val(), "MM-DD-YYYY").add($('#frm_schedule_until').val().split(' ')[0], 'M').format('YYYY-MM-DD')
            //console.log(new_date)
            //$('#end_date').val(new_date)
        }
    });
    
    $('#c_frm_class_meets').change(function() {
		//console.log($("#startingpicker").val())
		if ($("#c_frm_class_meets").val() == 'Weekly') 
		{
			$(".c_schedule_until_box").show()
			if ($("#c_startingpicker").val() != '') 
			{
				
				$("#sunbox").show();
				$("#monbox").show();
				$("#tuebox").show();
				$("#wedbox").show();
				$("#thubox").show();
				$("#fribox").show();
				$("#satbox").show();
				$("#checkbox1").prop("checked", false);
				$("#checkbox2").prop("checked", false);
				$("#checkbox3").prop("checked", false);
				$("#checkbox4").prop("checked", false);
				$("#checkbox5").prop("checked", false);
				$("#checkbox6").prop("checked", false);
				$("#checkbox7").prop("checked", false);
				if ($("#c_startingpicker").val() != '') 
				{
					var date = $('#c_startingpicker').datepicker('getDate');
                    var day = $.datepicker.formatDate('DD', date);
														
					if (day == 'Monday') {
						$("#checkbox2").prop("checked", true);
						$(".c_monday_start").show();
						$(".c_tuesday_start").hide();
						$(".c_wednesday_start").hide();
						$(".c_thrusday_start").hide();
						$(".c_friday_start").hide();
						$(".c_saturday_start").hide();
						$(".c_sunday_start").hide();
					}
					if (day == 'Tuesday') {
						$("#checkbox3").prop("checked", true);
						$(".c_monday_start").hide();
						$(".c_tuesday_start").show();
						$(".c_wednesday_start").hide();
						$(".c_thrusday_start").hide();
						$(".c_friday_start").hide();
						$(".c_saturday_start").hide();
						$(".c_sunday_start").hide();
					}
					if (day == 'Wednesday') {
						$("#checkbox4").prop("checked", true);
						$(".c_monday_start").hide();
						$(".c_tuesday_start").hide();
						$(".c_wednesday_start").show();
						$(".c_thrusday_start").hide();
						$(".c_friday_start").hide();
						$(".c_saturday_start").hide();
						$(".c_sunday_start").hide();
					}
					if (day == 'Thursday') {
						$("#checkbox5").prop("checked", true);
						$(".c_monday_start").hide();
						$(".c_tuesday_start").hide();
						$(".c_wednesday_start").hide();
						$(".c_thrusday_start").show();
						$(".c_friday_start").hide();
						$(".c_saturday_start").hide();
						$(".c_sunday_start").hide();
					}
					if (day == 'Friday') {
						$("#checkbox6").prop("checked", true);
						$(".c_monday_start").hide();
						$(".c_tuesday_start").hide();
						$(".c_wednesday_start").hide();
						$(".c_thrusday_start").hide();
						$(".c_friday_start").show();
						$(".c_saturday_start").hide();
						$(".c_sunday_start").hide();
					}
					if (day == 'Saturday') {
						$("#checkbox7").prop("checked", true);
						$(".c_monday_start").hide();
						$(".c_tuesday_start").hide();
						$(".c_wednesday_start").hide();
						$(".c_thrusday_start").hide();
						$(".c_friday_start").hide();
						$(".c_saturday_start").show();
						$(".c_sunday_start").hide();
					}
					if (day == 'Sunday') {
						$("#checkbox1").prop("checked", true);
						$(".c_monday_start").hide();
						$(".c_tuesday_start").hide();
						$(".c_wednesday_start").hide();
						$(".c_thrusday_start").hide();
						$(".c_friday_start").hide();
						$(".c_saturday_start").hide();
						$(".c_sunday_start").show();
					}
				}
				
			}
		}
		else 
		{
			$(".c_schedule_until_box").hide()
			if ($("#c_startingpicker").val() != '') 
			{
				var date = $('#c_startingpicker').datepicker('getDate');
                var day = $.datepicker.formatDate('DD', date);
				if (day == 'Monday') {
                    $(".c_Sunday").hide();
                    $(".c_Monday").show();
                    $(".c_Tuesday").hide();
                    $(".c_Wednesday").hide();
                    $(".c_Thrusday").hide();
                    $(".c_Friday").hide();
                    $(".c_Saturday").hide();
                    $("#checkbox2").prop("checked", true);
                    $(".c_monday_start").show();
                    $(".c_tuesday_start").hide();
                    $(".c_wednesday_start").hide();
                    $(".c_thrusday_start").hide();
                    $(".c_friday_start").hide();
                    $(".c_saturday_start").hide();
                    $(".c_sunday_start").hide();
                    $(".c_Monday").addClass('day_circle_fill')
                }
                if (day == 'Tuesday') {                
                    $(".c_Sunday").hide();
                    $(".c_Monday").hide();
                    $(".c_Tuesday").show();
                    $(".c_Wednesday").hide();
                    $(".c_Thrusday").hide();
                    $(".c_Friday").hide();
                    $(".c_Saturday").hide();
                    $("#checkbox3").prop("checked", true);
                    $(".c_tuesday_start").show();
                    $(".c_monday_start").hide();
                    $(".c_wednesday_start").hide();
                    $(".c_thrusday_start").hide();
                    $(".c_friday_start").hide();
                    $(".c_saturday_start").hide();
                    $(".c_sunday_start").hide();
                    $(".c_Tuesday").addClass('day_circle_fill')
                }
                if (day == 'Wednesday') {
                    $(".c_Sunday").hide();
                    $(".c_Monday").hide();
                    $(".c_Tuesday").hide();
                    $(".c_Wednesday").show();
                    $(".c_Thrusday").hide();
                    $(".c_Friday").hide();
                    $(".c_Saturday").hide();
                    $("#checkbox4").prop("checked", true);
                    $(".c_wednesday_start").show();
                    $(".c_monday_start").hide();
                    $(".c_tuesday_start").hide();
                    $(".c_thrusday_start").hide();
                    $(".c_friday_start").hide();
                    $(".c_saturday_start").hide();
                    $(".c_sunday_start").hide();
                    $(".c_Wednesday").addClass('day_circle_fill')
                }
                if (day == 'Thursday') {
                    $(".c_Sunday").hide();
                    $(".c_Monday").hide();
                    $(".c_Tuesday").hide();
                    $(".c_Wednesday").hide();
                    $(".c_Thrusday").show();
                    $(".c_Friday").hide();
                    $(".c_Saturday").hide();
                    $("#checkbox5").prop("checked", true);
                    $(".c_thrusday_start").show();
                    $(".c_monday_start").hide();
                    $(".c_tuesday_start").hide();
                    $(".c_wednesday_start").hide();
                    $(".c_friday_start").hide();
                    $(".c_saturday_start").hide();
                    $(".c_sunday_start").hide();
                    $(".c_Thrusday").addClass('day_circle_fill')
                }
                if (day == 'Friday') {
                    $(".c_Sunday").hide();
                    $(".c_Monday").hide();
                    $(".c_Tuesday").hide();
                    $(".c_Wednesday").hide();
                    $(".c_Thrusday").hide();
                    $(".c_Friday").show();
                    $(".c_Saturday").hide();
                    $("#checkbox6").prop("checked", true);
                    $(".c_friday_start").show();
                    $(".c_monday_start").hide();
                    $(".c_tuesday_start").hide();
                    $(".c_wednesday_start").hide();
                    $(".c_thrusday_start").hide();
                    $(".c_saturday_start").hide();
                    $(".c_sunday_start").hide();
                    $(".c_Friday").addClass('day_circle_fill')
                }
                if (day == 'Saturday') {
                    $(".c_Sunday").hide();
                    $(".c_Monday").hide();
                    $(".c_Tuesday").hide();
                    $(".c_Wednesday").hide();
                    $(".c_Thrusday").hide();
                    $(".c_Friday").hide();
                    $(".c_Saturday").show();
                    $("#checkbox7").prop("checked", true);
                    $(".c_saturday_start").show();
                    $(".c_monday_start").hide();
                    $(".c_tuesday_start").hide();
                    $(".c_wednesday_start").hide();
                    $(".c_thrusday_start").hide();
                    $(".c_friday_start").hide();
                    $(".c_sunday_start").hide();
                    $(".c_Saturday").addClass('day_circle_fill')
                }
                if (day == 'Sunday') {
                    $(".c_Sunday").show();
                    $(".c_Monday").hide();
                    $(".c_Tuesday").hide();
                    $(".c_Wednesday").hide();
                    $(".c_Thrusday").hide();
                    $(".c_Friday").hide();
                    $(".c_Saturday").hide();
                    $("#checkbox1").prop("checked", true);
                    $(".c_sunday_start").show();
                    $(".c_monday_start").hide();
                    $(".c_tuesday_start").hide();
                    $(".c_wednesday_start").hide();
                    $(".c_thrusday_start").hide();
                    $(".c_friday_start").hide();
                    $(".c_saturday_start").hide();
                    $(".c_Sunday").addClass('day_circle_fill')
                }
			}
		}
	});
    
	$(".c_day-time-div-main").on('click', '.dys', function() {
        console.log($(this).attr('class'))
        if ($(this).attr('class').includes("day_circle_fill")) {
			
			//console.log('11');
            $(this).removeClass("day_circle_fill")
            if ($(this).attr('class').includes('Sunday')) {
				//console.log($(this).attr('class'))
                $(this).parent().parent().children().children(".c_sunday_start").hide()
                $(this).parent().parent().children().children(".c_sunday_start").children().children().children($("input[name='hours[sunday_start]']")).val('')
                $(this).parent().parent().children().children(".c_sunday_start").children().children().children($("input[name='hours[sunday_end]']")).val('')

            }
            if ($(this).attr('class').includes('Monday')) {
                $(this).parent().parent().children().children(".c_monday_start").hide()
                $(this).parent().parent().children().children(".c_monday_start").children().children().children($("input[name='hours[monday_start]']")).val('')
                $(this).parent().parent().children().children(".c_monday_start").children().children().children($("input[name='hours[monday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Tuesday')) {
                $(this).parent().parent().children().children(".c_tuesday_start").hide()
                $(this).parent().parent().children().children(".c_tuesday_start").children().children().children($("input[name='hours[tuesday_start]']")).val('')
                $(this).parent().parent().children().children(".c_tuesday_start").children().children().children($("input[name='hours[tuesday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Wednesday')) {
                $(this).parent().parent().children().children(".c_wednesday_start").hide()
                $(this).parent().parent().children().children(".c_wednesday_start").children().children().children($("input[name='hours[wednesday_start]']")).val('')
                $(this).parent().parent().children().children(".c_wednesday_start").children().children().children($("input[name='hours[wednesday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Thrusday')) {
                $(this).parent().parent().children().children(".c_thrusday_start").hide()
                $(this).parent().parent().children().children(".c_thrusday_start").children().children().children($("input[name='hours[thrusday_start]']")).val('')
                $(this).parent().parent().children().children(".c_thrusday_start").children().children().children($("input[name='hours[thrusday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Friday')) {
                $(this).parent().parent().children().children(".c_friday_start").hide()
                $(this).parent().parent().children().children(".c_friday_start").children().children().children($("input[name='hours[friday_start]']")).val('')
                $(this).parent().parent().children().children(".c_friday_start").children().children().children($("input[name='hours[friday_end]']")).val('')
            }
            if ($(this).attr('class').includes('Saturday')) {
                $(this).parent().parent().children().children(".c_saturday_start").hide()
                $(this).parent().parent().children().children(".c_saturday_start").children().children().children($("input[name='hours[saturday_start]']")).val('')
                $(this).parent().parent().children().children(".c_saturday_start").children().children().children($("input[name='hours[saturday_end]']")).val('')
            }
        } else {
            $(this).addClass("day_circle_fill")
            if ($(this).attr('class').includes('Sunday'))
			{  console.log('aa');
			console.log($(this).parent().parent().children('class'));
                $(this).parent().parent().children().children(".c_sunday_start").show()
			}
			if ($(this).attr('class').includes('Monday'))
                $(this).parent().parent().children().children(".c_monday_start").show()
            if ($(this).attr('class').includes('Tuesday'))
                $(this).parent().parent().children().children(".c_tuesday_start").show()
            if ($(this).attr('class').includes('Wednesday'))
                $(this).parent().parent().children().children(".c_wednesday_start").show()
            if ($(this).attr('class').includes('Thrusday'))
                $(this).parent().parent().children().children(".c_thrusday_start").show()
            if ($(this).attr('class').includes('Friday'))
                $(this).parent().parent().children().children(".c_friday_start").show()
            if ($(this).attr('class').includes('Saturday'))
                $(this).parent().parent().children().children(".c_saturday_start").show()
        }
        // if($(this).attr('class').includes('Sunday'))
        //         $(this).parent().parent().children().children(".sunday_start").show()
        //     if($(this).attr('class').includes('Monday'))
        //         $(this).parent().parent().children().children(".monday_start").show()
        //     if($(this).attr('class').includes('Tuesday'))
        //         $(this).parent().parent().children().children(".tuesday_start").show()
        //     if($(this).attr('class').includes('Wednesday'))
        //         $(this).parent().parent().children().children(".wednesday_start").show()
        //     if($(this).attr('class').includes('Thrusday'))
        //         $(this).parent().parent().children().children(".thrusday_start").show()
        //     if($(this).attr('class').includes('Friday'))
        //         $(this).parent().parent().children().children(".friday_start").show()
        //     if($(this).attr('class').includes('Saturday'))
        //         $(this).parent().parent().children().children(".saturday_start").show()
    })
	
	var i = 0
    $(".c_add-another-time").click(function() {
        i = i + 1;
        console.log("iii " + i)
        var str = '<div class="c_day-time-div">' +
            '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>' +
            '<div class="row" style="justify-content: center;">' +
            '<div class="col-sm-1 timezone-round day_circle c_Sunday dys">' +
            '<p>Su</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle c_Monday dys">' +
            '<p>Mo</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle c_Tuesday dys">' +
            '<p>Tu</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle c_Wednesday dys">' +
            '<p>We</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle c_Thrusday dys">' +
            '<p>Th</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle c_Friday dys">' +
            '<p>Fr</p>' +
            '</div>' +
            '<div class="col-sm-1 timezone-round day_circle c_Saturday dys">' +
            '<p>Sa</p>' +
            '</div>' +
            '</div>' +
            '<div class="wrapperow">' +
			'<div class="col-md-12 c_sunday_start" style="display:none;">'+
			'<div class="col-md-12">Sunday Time</div>'+
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="c_sunquicktimepicker' + i + ' form-control" id="suntime" name="hours[sunday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				  
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="c_timepicker form-control" name="hours[sunday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
					  
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="sunduration' + i + '" id="c_sunduration' + i + '" class="form-control">'+
			'<option value="">30 Minutes</option>'+
			'<option value="">45 Minutes</option>'+
			'<option value="">1 Hours</option>'+
			'<option value="">2 Hours</option>'+
			'<option value="">3 Hours</option>'+
			'<option value="">4 Hours</option>'+
			'<option value="">5 Hours</option>'+
			'<option value="">6 Hours</option>'+
			'<option value="">7 Hours</option>'+
			'<option value="">8 Hours</option>'+
			'<option value="">9 Hours</option>'+
			'<option value="">10 Hours</option>'+
			'<option value="">1 Day</option>'+
			'<option value="">2 Days</option>'+
			'<option value="">3 Days</option>'+
			'<option value="">4 Days</option>'+
			'<option value="">5 Days</option>'+
			'<option value="">6 Days</option>'+
			'<option value="">7 Days</option>'+
			'<option value="">8 Days</option>'+
			'<option value="">9 Days</option>'+
			'<option value="">10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+<!--sundaystart-->
			  
			'<div class="col-md-12 c_monday_start" style="display:none;">'+
			'<div class="col-md-12">Monday Time</div>'+
					  
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="c_monquicktimepicker' + i + ' form-control" name="hours[monday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				  
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="c_timepicker form-control" name="hours[monday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
					  
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="monduration' + i + '" id="c_monduration' + i + '" class="form-control">'+
			'<option value="">30 Minutes</option>'+
			'<option value="">45 Minutes</option>'+
			'<option value="">1 Hours</option>'+
			'<option value="">2 Hours</option>'+
			'<option value="">3 Hours</option>'+
			'<option value="">4 Hours</option>'+
			'<option value="">5 Hours</option>'+
			'<option value="">6 Hours</option>'+
			'<option value="">7 Hours</option>'+
			'<option value="">8 Hours</option>'+
			'<option value="">9 Hours</option>'+
			'<option value="">10 Hours</option>'+
			'<option value="">1 Day</option>'+
			'<option value="">2 Days</option>'+
			'<option value="">3 Days</option>'+
			'<option value="">4 Days</option>'+
			'<option value="">5 Days</option>'+
			'<option value="">6 Days</option>'+
			'<option value="">7 Days</option>'+
			'<option value="">8 Days</option>'+
			'<option value="">9 Days</option>'+
			'<option value="">10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+<!--mondaystart-->
			  
			'<div class="col-md-12 c_tuesday_start" style="display:none;">'+
															
			'<div class="col-md-12">Tuesday Time</div>'+
					
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="c_tuesquicktimepicker' + i + ' form-control" name="hours[tuesday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="c_timepicker form-control" name="hours[tuesday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
					
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="tuesduration' + i + '" id="c_tuesduration' + i + '" class="form-control">'+
			'<option value="">30 Minutes</option>'+
			'<option value="">45 Minutes</option>'+
			'<option value="">1 Hours</option>'+
			'<option value="">2 Hours</option>'+
			'<option value="">3 Hours</option>'+
			'<option value="">4 Hours</option>'+
			'<option value="">5 Hours</option>'+
			'<option value="">6 Hours</option>'+
			'<option value="">7 Hours</option>'+
			'<option value="">8 Hours</option>'+
			'<option value="">9 Hours</option>'+
			'<option value="">10 Hours</option>'+
			'<option value="">1 Day</option>'+
			'<option value="">2 Days</option>'+
			'<option value="">3 Days</option>'+
			'<option value="">4 Days</option>'+
			'<option value="">5 Days</option>'+
			'<option value="">6 Days</option>'+
			'<option value="">7 Days</option>'+
			'<option value="">8 Days</option>'+
			'<option value="">9 Days</option>'+
			'<option value="">10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+<!--tuesdaystart-->
			
			'<div class="col-md-12 c_wednesday_start" style="display:none;">'+
														
			'<div class="col-md-12">Wednesday Time</div>'+
					
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="c_wedquicktimepicker' + i + ' form-control" name="hours[wednesday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="c_timepicker form-control" name="hours[wednesday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
					
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="wedduration' + i + '" id="c_wedduration' + i + '" class="form-control">'+
			'<option value="">30 Minutes</option>'+
			'<option value="">45 Minutes</option>'+
			'<option value="">1 Hours</option>'+
			'<option value="">2 Hours</option>'+
			'<option value="">3 Hours</option>'+
			'<option value="">4 Hours</option>'+
			'<option value="">5 Hours</option>'+
			'<option value="">6 Hours</option>'+
			'<option value="">7 Hours</option>'+
			'<option value="">8 Hours</option>'+
			'<option value="">9 Hours</option>'+
			'<option value="">10 Hours</option>'+
			'<option value="">1 Day</option>'+
			'<option value="">2 Days</option>'+
			'<option value="">3 Days</option>'+
			'<option value="">4 Days</option>'+
			'<option value="">5 Days</option>'+
			'<option value="">6 Days</option>'+
			'<option value="">7 Days</option>'+
			'<option value="">8 Days</option>'+
			'<option value="">9 Days</option>'+
			'<option value="">10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+<!--wednesdaystart-->
			
			'<div class="col-md-12 c_thrusday_start" style="display:none;">'+
															
			'<div class="col-md-12">Thursday Time</div>'+
				  
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="c_thrusquicktimepicker' + i + ' form-control" name="hours[thrusday_start]" autocomplete="off" style=" width:100%" >'+
			'</div>'+
			  
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="c_timepicker form-control" name="hours[thrusday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				  
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="thuduration' + i + '" id="c_thuduration' + i + '" class="form-control">'+
			'<option value="">30 Minutes</option>'+
			'<option value="">45 Minutes</option>'+
			'<option value="">1 Hours</option>'+
			'<option value="">2 Hours</option>'+
			'<option value="">3 Hours</option>'+
			'<option value="">4 Hours</option>'+
			'<option value="">5 Hours</option>'+
			'<option value="">6 Hours</option>'+
			'<option value="">7 Hours</option>'+
			'<option value="">8 Hours</option>'+
			'<option value="">9 Hours</option>'+
			'<option value="">10 Hours</option>'+
			'<option value="">1 Day</option>'+
			'<option value="">2 Days</option>'+
			'<option value="">3 Days</option>'+
			'<option value="">4 Days</option>'+
			'<option value="">5 Days</option>'+
			'<option value="">6 Days</option>'+
			'<option value="">7 Days</option>'+
			'<option value="">8 Days</option>'+
			'<option value="">9 Days</option>'+
			'<option value="">10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+<!--thursdaystart-->
			
            '<div class="col-md-12 c_friday_start" style="display:none;">'+
															
			'<div class="col-md-12">Friday Time</div>'+
				
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="c_friquicktimepicker' + i + ' form-control" name="hours[friday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
			
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="c_timepicker form-control" name="hours[friday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
				
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="friduration' + i + '" id="c_friduration' + i + '" class="form-control">'+
			'<option value="">30 Minutes</option>'+
			'<option value="">45 Minutes</option>'+
			'<option value="">1 Hours</option>'+
			'<option value="">2 Hours</option>'+
			'<option value="">3 Hours</option>'+
			'<option value="">4 Hours</option>'+
			'<option value="">5 Hours</option>'+
			'<option value="">6 Hours</option>'+
			'<option value="">7 Hours</option>'+
			'<option value="">8 Hours</option>'+
			'<option value="">9 Hours</option>'+
			'<option value="">10 Hours</option>'+
			'<option value="">1 Day</option>'+
			'<option value="">2 Days</option>'+
			'<option value="">3 Days</option>'+
			'<option value="">4 Days</option>'+
			'<option value="">5 Days</option>'+
			'<option value="">6 Days</option>'+
			'<option value="">7 Days</option>'+
			'<option value="">8 Days</option>'+
			'<option value="">9 Days</option>'+
			'<option value="">10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+<!--fridaystart-->
			
            '<div class="col-md-12 c_saturday_start" style="display:none;">'+
															
			'<div class="col-md-12">Saturday Time</div>'+
			  
			'<div class="form-group col-md-4">'+
			'<label>From</label>'+
			'<input type="text" class="c_satquicktimepicker' + i + ' form-control" name="hours[saturday_start]" autocomplete="off" style=" width:100%">'+
			'</div>'+
		  
			'<div class="form-group col-md-4">'+
			'<label>To</label>'+
			'<input type="text" class="c_timepicker form-control" name="hours[saturday_end]" autocomplete="off" style=" width:100%">'+
			'</div>'+
			  
			'<div class="form-group col-md-4">'+
			'<label>Duration</label>'+
			'<select name="satduration' + i + '" id="c_satduration' + i + '" class="form-control">'+
			'<option value="">30 Minutes</option>'+
			'<option value="">45 Minutes</option>'+
			'<option value="">1 Hours</option>'+
			'<option value="">2 Hours</option>'+
			'<option value="">3 Hours</option>'+
			'<option value="">4 Hours</option>'+
			'<option value="">5 Hours</option>'+
			'<option value="">6 Hours</option>'+
			'<option value="">7 Hours</option>'+
			'<option value="">8 Hours</option>'+
			'<option value="">9 Hours</option>'+
			'<option value="">10 Hours</option>'+
			'<option value="">1 Day</option>'+
			'<option value="">2 Days</option>'+
			'<option value="">3 Days</option>'+
			'<option value="">4 Days</option>'+
			'<option value="">5 Days</option>'+
			'<option value="">6 Days</option>'+
			'<option value="">7 Days</option>'+
			'<option value="">8 Days</option>'+
			'<option value="">9 Days</option>'+
			'<option value="">10 Days</option>'+
			'</select>'+
			'</div>'+
			'</div>'+<!--saturdaystart-->
		  
			'</div>'+
            '</div>';

        $(".c_day-time-div-main").append(str);
        
    });
	
	
	$("#c_frm_schedule_until").change(function() {
        if ($('#c_startingpicker').val() != '') {
			var res=$('#c_frm_schedule_until').val().split(' ');
			var incmonth=res[0];
			var date = $('#c_startingpicker').datepicker('getDate');
			var second_date = new Date(date);
			second_date.setMonth(second_date.getMonth()+2);
			//second_date.setMonth(second_date.getMonth()+incmonth);
			console.log(second_date);
			var second_date1 = new Date(second_date),
			mnth = ("0" + (second_date1.getMonth() + 1)).slice(-2),
			day = ("0" + second_date1.getDate()).slice(-2);
			var fulldate= [mnth,day,second_date1.getFullYear()].join("/");
			
			$("#c_end_date").val(fulldate);
            //var new_date = moment($('#startingpicker').val(), "MM-DD-YYYY").add($('#frm_schedule_until').val().split(' ')[0], 'M').format('YYYY-MM-DD')
            //console.log(new_date)
            //$('#end_date').val(new_date)
        }
    });

});

function hasDuplicates(array) {
	return (new Set(array)).size !== array.length;
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .timepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		change: function(time) {
			console.log('timer_start_arr');
			/*if ($(this).parent().parent().children(':nth-child(3)').children().val() == '') {
				$(this).val('')
				showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select TO time without selecting from time.');
			}*/
	
		}
	});
}
//sunquicktimepicker
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .sunquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		change: function(time) {
			console.log('sunday_start_arr');
			/*var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			console.log(sunday_start_arr)
			setTimeout(function() {
				var g = hasDuplicates(sunday_start_arr)
				console.log(g)
				if (g == true) {
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
					$(".sunquicktimepicker").val('')
				}
			}, 100)*/
		}
	});
}
/*$('.day-time-div-main .day-time-div1 .wrapperow1 input[name="hours[sunday_start]"]').timepicker({
	timeFormat: 'h:mm p',
	interval: 15,
	//defaultTime: '11',
	startTime: '5:00',
	dynamic: true,
	dropdown: true,
	scrollbar: true,
	change: function(time) {
		console.log('sunday_start_arr sub');
		var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function() {
			return this.value; // $(this).val()
		}).get();
		console.log(sunday_start_arr)
		setTimeout(function() {
			var g = hasDuplicates(sunday_start_arr)
			console.log(g)
			if (g == true) {
				showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
				$(".sunquicktimepicker").val('')
			}
		}, 100)
	}
});
*/
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .monquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		/*change: function(time) {
			var sunday_start_arr = $('input[name="hours[monday_start]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			setTimeout(function() {
				var g = hasDuplicates(sunday_start_arr)
				console.log(g)
				if (g == true) {
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
					$(".monquicktimepicker").val('')
				}
			}, 100)
		}*/
	});
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .tuesquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		/*change: function(time) {
			var sunday_start_arr = $('input[name="hours[tuesday_start]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			setTimeout(function() {
				var g = hasDuplicates(sunday_start_arr)
				console.log(g)
				if (g == true) {
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
					$(".tuesquicktimepicker").val('')
				}
			}, 100)
		}*/
		
	});
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .wedquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		/*change: function(time) {
			var sunday_start_arr = $('input[name="hours[wednesday_start]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			setTimeout(function() {
				var g = hasDuplicates(sunday_start_arr)
				console.log(g)
				if (g == true) {
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
					$(".wedquicktimepicker").val('')
				}
			}, 100)
		}*/
	});
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .thrusquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		/*change: function(time) {
			var sunday_start_arr = $('input[name="hours[thrusday_start]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			setTimeout(function() {
				var g = hasDuplicates(sunday_start_arr)
				console.log(g)
				if (g == true) {
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
					$(".thrusquicktimepicker").val('')
				}
			}, 100)
		}*/
	});
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .friquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		/*change: function(time) {
			var sunday_start_arr = $('input[name="hours[friday_start]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			setTimeout(function() {
				var g = hasDuplicates(sunday_start_arr)
				console.log(g)
				if (g == true) {
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
					$(".friquicktimepicker").val('')
				}
			}, 100)
		}*/
	});
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .satquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		/*change: function(time) {
			var sunday_start_arr = $('input[name="hours[saturday_start]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			setTimeout(function() {
				var g = hasDuplicates(sunday_start_arr)
				console.log(g)
				if (g == true) {
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
					$(".satquicktimepicker").val('')
				}
			}, 100)
		}*/
	});
}

/*function myDayFunction() {
	if ($("#startingpicker").val() != '') 
	{
		var date = $('#startingpicker').datepicker('getDate');
		var day = $.datepicker.formatDate('DD', date);
		if ($("#frm_class_meets").val() != 'Weekly') 
		{
			if (day == 'Monday') 
			{
				$("#sunbox").hide();
				$("#monbox").show();
				$("#tuebox").hide();
				$("#wedbox").hide();
				$("#thubox").hide();
				$("#fribox").hide();
				$("#satbox").hide();
				$("#checkbox2").prop("checked", true);
				$(".monday_start").show();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Monday").addClass('day_circle_fill')
			}
			if (day == 'Tuesday') 
			{
				$("#sunbox").hide();
				$("#monbox").hide();
				$("#tuebox").show();
				$("#wedbox").hide();
				$("#thubox").hide();
				$("#fribox").hide();
				$("#satbox").hide();
				$("#checkbox3").prop("checked", true);
				$(".tuesday_start").show();
				$(".monday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Tuesday").addClass('day_circle_fill')
			}
			if (day == 'Wednesday') 
			{
				$("#sunbox").hide();
				$("#monbox").hide();
				$("#tuebox").hide();
				$("#wedbox").show();
				$("#thubox").hide();
				$("#fribox").hide();
				$("#satbox").hide();
				$("#checkbox4").prop("checked", true);
				$(".wednesday_start").show();
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Wednesday").addClass('day_circle_fill')
			}
			if (day == 'Thursday') 
			{
				$("#sunbox").hide();
				$("#monbox").hide();
				$("#tuebox").hide();
				$("#wedbox").hide();
				$("#thubox").show();
				$("#fribox").hide();
				$("#satbox").hide();
				$("#checkbox5").prop("checked", true);
				$(".thrusday_start").show();
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Thrusday").addClass('day_circle_fill')
			}
			if (day == 'Friday') 
			{
				$("#sunbox").hide();
				$("#monbox").hide();
				$("#tuebox").hide();
				$("#wedbox").hide();
				$("#thubox").hide();
				$("#fribox").show();
				$("#satbox").hide();
				$("#checkbox6").prop("checked", true);
				$(".friday_start").show();
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Friday").addClass('day_circle_fill')
			}
			if (day == 'Saturday') 
			{
				$("#sunbox").hide();
				$("#monbox").hide();
				$("#tuebox").hide();
				$("#wedbox").hide();
				$("#thubox").hide();
				$("#fribox").hide();
				$("#satbox").show();
				$("#checkbox7").prop("checked", true);
				$(".saturday_start").show();
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".sunday_start").hide();
				$(".Saturday").addClass('day_circle_fill')
			}
			if (day == 'Sunday') 
			{
				$("#sunbox").show();
				$("#monbox").hide();
				$("#tuebox").hide();
				$("#wedbox").hide();
				$("#thubox").hide();
				$("#fribox").hide();
				$("#satbox").hide();
				$("#checkbox1").prop("checked", true);
				$(".sunday_start").show();
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".Sunday").addClass('day_circle_fill')
			}
		}
		else
		{
			if (day == 'Monday') {
				$("#checkbox2").prop("checked", true);
				$(".monday_start").show();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Monday").addClass('day_circle_fill')
			}
			if (day == 'Tuesday') {
				$("#checkbox3").prop("checked", true);
				$(".monday_start").hide();
				$(".tuesday_start").show();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Tuesday").addClass('day_circle_fill')
			}
			if (day == 'Wednesday') {
				$("#checkbox4").prop("checked", true);
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".wednesday_start").show();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Wednesday").addClass('day_circle_fill')
			}
			if (day == 'Thursday') {
				$("#checkbox5").prop("checked", true);
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").show();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Thrusday").addClass('day_circle_fill')
			}
			if (day == 'Friday') {
				$("#checkbox6").prop("checked", true);
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").show();
				$(".saturday_start").hide();
				$(".sunday_start").hide();
				$(".Friday").addClass('day_circle_fill')
			}
			if (day == 'Saturday') {
				$("#checkbox7").prop("checked", true);
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").show();
				$(".sunday_start").hide();
				$(".Saturday").addClass('day_circle_fill')
			}
			if (day == 'Sunday') {
				$("#checkbox1").prop("checked", true);
				$(".monday_start").hide();
				$(".tuesday_start").hide();
				$(".wednesday_start").hide();
				$(".thrusday_start").hide();
				$(".friday_start").hide();
				$(".saturday_start").hide();
				$(".sunday_start").show();
				$(".Sunday").addClass('day_circle_fill')
			}
		}
	}
}*/

if ( $( ".c_day-time-div-main" ).length ) {
	$('.c_day-time-div-main .c_timepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
	});
}
if ( $( ".c_day-time-div-main" ).length ) {
	$('.c_day-time-div-main .c_sunquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
	});
}
if ( $( ".c_day-time-div-main" ).length ) {
	$('.c_day-time-div-main .c_monquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
	});
}
if ( $( ".c_day-time-div-main" ).length ) {
	$('.c_day-time-div-main .c_tuesquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
	
	});
}
if ( $( ".c_day-time-div-main" ).length ) {
	$('.c_day-time-div-main .c_wedquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
	});
}
if ( $( ".c_day-time-div-main" ).length ) {
	$('.c_day-time-div-main .c_thrusquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
	});
}
if ( $( ".c_day-time-div-main" ).length ) {
	$('.c_day-time-div-main .c_friquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
	});
}
if ( $( ".c_day-time-div-main" ).length ) {
	$('.c_day-time-div-main .c_satquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 15,
		//defaultTime: '11',
		startTime: '5:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,    
	});
}

/*function myDayFunction() {
    if ($("#c_startingpicker").val() != '') {
        var date = $('#c_startingpicker').datepicker('getDate');
        var day = $.datepicker.formatDate('DD', date);
        if ($("#c_frm_class_meets").val() != 'Weekly') {
            if (day == 'Monday') {
                $(".c_Sunday").hide();
                $(".c_Monday").show();
                $(".c_Tuesday").hide();
                $(".c_Wednesday").hide();
                $(".c_Thrusday").hide();
                $(".c_Friday").hide();
                $(".c_Saturday").hide();
                $("#checkbox2").prop("checked", true);
                $(".c_monday_start").show();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Monday").addClass('day_circle_fill');
            }
            if (day == 'Tuesday') {                
                $(".c_Sunday").hide();
                $(".c_Monday").hide();
                $(".c_Tuesday").show();
                $(".c_Wednesday").hide();
                $(".c_Thrusday").hide();
                $(".c_Friday").hide();
                $(".c_Saturday").hide();
                $("#checkbox3").prop("checked", true);
                $(".c_tuesday_start").show();
                $(".c_monday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Tuesday").addClass('day_circle_fill');
            }
            if (day == 'Wednesday') {
                $(".c_Sunday").hide();
                $(".c_Monday").hide();
                $(".c_Tuesday").hide();
                $(".c_Wednesday").show();
                $(".c_Thrusday").hide();
                $(".c_Friday").hide();
                $(".c_Saturday").hide();
                $("#checkbox4").prop("checked", true);
                $(".c_wednesday_start").show();
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Wednesday").addClass('day_circle_fill');
            }
            if (day == 'Thursday') {
                $(".c_Sunday").hide();
                $(".c_Monday").hide();
                $(".c_Tuesday").hide();
                $(".c_Wednesday").hide();
                $(".c_Thrusday").show();
                $(".c_Friday").hide();
                $(".c_Saturday").hide();
                $("#checkbox5").prop("checked", true);
                $(".c_thrusday_start").show();
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Thrusday").addClass('day_circle_fill');
            }
            if (day == 'Friday') {
                $(".c_Sunday").hide();
                $(".c_Monday").hide();
                $(".c_Tuesday").hide();
                $(".c_Wednesday").hide();
                $(".c_Thrusday").hide();
                $(".c_Friday").show();
                $(".c_Saturday").hide();
                $("#checkbox6").prop("checked", true);
                $(".c_friday_start").show();
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Friday").addClass('day_circle_fill');
            }
            if (day == 'Saturday') {
                $(".c_Sunday").hide();
                $(".c_Monday").hide();
                $(".c_Tuesday").hide();
                $(".c_Wednesday").hide();
                $(".c_Thrusday").hide();
                $(".c_Friday").hide();
                $(".c_Saturday").show();
                $("#checkbox7").prop("checked", true);
                $(".c_saturday_start").show();
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Saturday").addClass('day_circle_fill');
            }
            if (day == 'Sunday') {
                $(".c_Sunday").show();
                $(".c_Monday").hide();
                $(".c_Tuesday").hide();
                $(".c_Wednesday").hide();
                $(".c_Thrusday").hide();
                $(".c_Friday").hide();
                $(".c_Saturday").hide();
                $("#checkbox1").prop("checked", true);
                $(".c_sunday_start").show();
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_Sunday").addClass('day_circle_fill');
            }
        } else {
            if (day == 'Monday') {
                $("#checkbox2").prop("checked", true);
                $(".c_monday_start").show();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Monday").addClass('day_circle_fill');
            }
            if (day == 'Tuesday') {
                $("#checkbox3").prop("checked", true);
                $(".c_monday_start").hide();
                $(".c_tuesday_start").show();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Tuesday").addClass('day_circle_fill');
            }
            if (day == 'Wednesday') {
                $("#checkbox4").prop("checked", true);
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").show();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Wednesday").addClass('day_circle_fill');
            }
            if (day == 'Thursday') {
                $("#checkbox5").prop("checked", true);
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").show();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Thrusday").addClass('day_circle_fill');
            }
            if (day == 'Friday') {
                $("#checkbox6").prop("checked", true);
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").show();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").hide();
                $(".c_Friday").addClass('day_circle_fill');
            }
            if (day == 'Saturday') {
                $("#checkbox7").prop("checked", true);
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").show();
                $(".c_sunday_start").hide();
                $(".c_Saturday").addClass('day_circle_fill');
            }
            if (day == 'Sunday') {
                $("#checkbox1").prop("checked", true);
                $(".c_monday_start").hide();
                $(".c_tuesday_start").hide();
                $(".c_wednesday_start").hide();
                $(".c_thrusday_start").hide();
                $(".c_friday_start").hide();
                $(".c_saturday_start").hide();
                $(".c_sunday_start").show();
                $(".c_Sunday").addClass('day_circle_fill');
            }
        }
    }
}*/


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#showimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#imgInp").change(function () {
    readURL(this);
});



$(".imgAdd").click(function () {
    $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
});
$(document).on("click", "i.del", function () {
    // 	to remove card
    $(this).parent().remove();
    // to clear image
    // $(this).parent().find('.imagePreview').css("background-image","url('')");
});
$(function () {
    $(document).on("change", ".uploadFile", function () {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
            }
        }

    });
});
$("label.present_work_btn").click(function () {

    $("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));

    changeDateBasedonPresent();

});



function changeDateBasedonPresent()

{

    if ($("#frm_ispresentcheck").attr("checked")) {

        $("#frm_ispresent").val("1");

        $("#dp2").val("Till Date");

        $("#dp2").attr("disabled", true);

    } else {

        $("#frm_ispresent").val("0");

        $("#dp2").val("");

        $("#dp2").attr("disabled", false);

    }

}



$(document).on('click', '.edlt', function () {

    // addServiceEditModal

    var serv = $(this).attr('service_id');

    editService(serv)

})



$(document).on('click', '#addServiceEditModal #submit_service', function () {

    setTimeout(function () {

        $('#addServiceEditModal').hide();

        getMyService();

        $('#step6').show();

    }, 1000)



})



function getMyService() {

    $.ajax({

        url: '/getMyService?arr_service=' + JSON.stringify(arr_service),

        type: 'get',

        beforeSend: function () {

            $('.loader').show();

        },

        complete: function () {

            $('.loader').hide();

        },

        success: function (response) {

            var mystr = '';

            console.log(response)

            response.data.forEach(function (value, key) {

                mystr = mystr + '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ' + response.data[key].id + '">' +

                    '<div class="services-list">' +

                    '<a href="#" class="decoration-none">' +

                    '<span class="brfcse"><i class="fa fa-briefcase"></i></span>' +

                    '</a>' +

                    '<div class="clearfix"></div>' +

                    '<h3>' +



                    '<span class="display_servicesport" style="padding-left: 30px;">' + response.data[key].sport_name + '</span>' +



                    '<a href="#" onclick="return false" service_id=' + response.data[key].id + ' class="delete_icon edlt"  disabled title="Edit this Service"><i class="fa fa-edit"></i></a>' +



                    '<a href="#" onclick="return false" service_id=' + response.data[key].id + ' class="delete_icon dlt"  disabled title="Delete this Service"><i class="fa fa-trash"></i></a>' +



                    '</h3>' +

                    '<div class="clearfix"></div>' +





                    '<p class="display_servicetitle"><strong>' + response.data[key].title + ' ' + response.data[key].price + '</strong></p>' +

                    '<div class="clearfix"></div>' +



                    '<p class="display_servicedesc">' + response.data[key].servicedesc + '</p>' +

                    ' </div>' +

                    '</div>';

            })

            $('#service_div').empty();

            $('#service_div').append(mystr);



        }

    });

}



function editService(rowcount)

{

    $.ajax({

        url: '/get_serviceform2/' + rowcount,

        type: 'get',

        beforeSend: function () {

            $('.loader').show();

        },

        complete: function () {

            $('.loader').hide();

        },

        success: function (response) {

            $('#step6').hide()

            $('#addServiceEditModal').html(response);

            $('#addServiceEditModal').show();



            var frm_agerange = new SlimSelect({

                select: '#frm_agerange'

            });

            var pp2 = new SlimSelect({

                select: '#frm_servicefocuses'

            });

            var frm_servicelocation = new SlimSelect({

                select: '#frm_servicelocation'

            });

            var teaching = new SlimSelect({

                select: '#teaching'

            });

            var categ = new SlimSelect({

                select: '#categ'

            });

            var activitytype = new SlimSelect({

                select: '#activitytype'

            });

            var activitydesigned = new SlimSelect({

                select: '#activitydesigned'

            });

            var frm_programfor = new SlimSelect({

                select: '#frm_programfor'

            });

            var frm_experience_level = new SlimSelect({

                select: '#frm_experience_level'

            });

            var frm_numberofpeople = new SlimSelect({

                select: '#frm_numberofpeople'

            });

            //   var  activitytype= new SlimSelect({

            //     select: '#activitytype'

            //   });

            //   var  duration= new SlimSelect({

            //     select: '#duration'

            //   });

            var frm_specialdeals = new SlimSelect({

                select: '#frm_specialdeals'

            });

            var frm_servicepriceoption = new SlimSelect({

                select: '#frm_servicepriceoption'

            });

        }

    });





}



$("#add_service").click(function () {

    $('#addServiceModal').show();

    $('#step6').hide();

    //   $.ajax({

    //   url:'/get_serviceform',

    //   type:'get',

    //   beforeSend: function () {

    //      $('.loader').show();

    //   },

    //   complete: function () {

    //      $('.loader').hide();

    //   },

    //   success: function (response) { 



    //      $('#addService').show();

    //     //   $('#step6').hide();

    //     $('#addService').html(response);

    //     $('#addService').modal('show');



    //     $('#CreateCompanyModal').modal('hide');

    // setTimeout(function(){

    $('#stepbtn1').removeAttr('onclick')

    $('#stepbtn2').removeAttr('onclick')

    $('#stepbtnwhen').removeAttr('onclick')



    $('#stepbtn1').removeAttr('href')

    $('#stepbtn2').removeAttr('href')

    $('#stepbtnwhen').removeAttr('href')



    $('#submit_service').attr('type', 'button')

    var frm_agerange = new SlimSelect({

        select: '#frm_agerange'

    });

    var pp2 = new SlimSelect({

        select: '#frm_servicefocuses'

    });

    var frm_servicelocation = new SlimSelect({

        select: '#frm_servicelocation'

    });

    var teaching = new SlimSelect({

        select: '#teaching'

    });

    var categ = new SlimSelect({

        select: '#categ'

    });

    var activitytype = new SlimSelect({

        select: '#activitytype'

    });

    var activitydesigned = new SlimSelect({

        select: '#activitydesigned'

    });

    var frm_programfor = new SlimSelect({

        select: '#frm_programfor'

    });

    var frm_experience_level = new SlimSelect({

        select: '#frm_experience_level'

    });

    var frm_numberofpeople = new SlimSelect({

        select: '#frm_numberofpeople'

    });

    //   var  activitytype= new SlimSelect({

    //     select: '#activitytype'

    //   });

    //   var  duration= new SlimSelect({

    //     select: '#duration'

    //   });

    var frm_specialdeals = new SlimSelect({

        select: '#frm_specialdeals'

    });

    var frm_servicepriceoption = new SlimSelect({

        select: '#frm_servicepriceoption'

    });

    //       },20)

    //     }

    // });



    $('#service_new').text('Add Your Program');

    $('#mayankstep1').show();
    $('#mayankstep2').hide();
    $('#mayankstep3').hide();

});

$('#dp1').Zebra_DatePicker({

    default_position: 'below',

    format: 'm-d-Y',

    container: $('#dp1-position')

});
$('#dp2').Zebra_DatePicker({

    default_position: 'below',

    format: 'm-d-Y',

    container: $('#dp2-position')

});

$('#completionyear').Zebra_DatePicker({

    default_position: 'below',

    format: 'm-d-Y',

    container: $('#completionpicker-position')

});

$('#skillcompletionpicker').Zebra_DatePicker({

    default_position: 'below',

    format: 'm-d-Y',

    container: $('#skillcompletionpicker-position')

});

var yesterdar = moment().format('MM-DD-YYYY')

/*$('#startingpicker').Zebra_DatePicker({

    default_position: 'below',

    format: 'm-d-Y',

    direction: [yesterdar, false],

    container: $('#startingpicker-position'),

    onSelect: function () {

        $('.day-time-div').slice(1).remove()

        $('input[name="hours[sunday_start]"]').val('')

        $('input[name="hours[monday_start]"]').val('')

        $('input[name="hours[tuesday_start]"]').val('')

        $('input[name="hours[wednesday_start]"]').val('')

        $('input[name="hours[thrusday_start]"]').val('')

        $('input[name="hours[friday_start]"]').val('')

        $('input[name="hours[saturday_start]"]').val('')

        $('input[name="hours[sunday_end]"]').val('')

        $('input[name="hours[tuesday_end]"]').val('')

        $('input[name="hours[wednesday_end]"]').val('')

        $('input[name="hours[thrusday_end]"]').val('')

        $('input[name="hours[friday_end]"]').val('')

        $('input[name="hours[saturday_end]"]').val('')

        $('input[name="hours[monday_end]"]').val('')

        $(".dys").removeClass('day_circle_fill')

        $(".sunday_start").hide()

        $(".tuesday_start").hide()

        $(".wednesday_start").hide()

        $(".thrusday_start").hide()

        $(".friday_start").hide()

        $(".monday_start").hide()

        $(".saturday_start").hide()

        var day = moment($(this).context.value, 'MM-DD-YYYY').format('dddd')

        var new_date = moment($('#startingpicker').val(), "MM-DD-YYYY").add($('#frm_schedule_until').val().split(' ')[0], 'M').format('YYYY-MM-DD')

        //console.log(new_date)

        $('#end_date').val(new_date)

        $('.mymy').show()

        if ($('#frm_class_meets').val() != 'Weekly') {

            if (day == 'Monday') {

                $(".Monday").show()

                $(".Monday").addClass('day_circle_fill')

                $(".monday_start").show()

                $(".Sunday").hide()

                $(".Tuesday").hide()

                $(".Wednesday").hide()

                $(".Thrusday").hide()

                $(".Friday").hide()

                $(".Saturday").hide()

            }

            if (day == 'Tuesday') {

                $(".Monday").hide()

                $(".Sunday").hide()

                $(".Tuesday").show()

                $(".Tuesday").addClass('day_circle_fill')

                $(".tuesday_start").show()

                $(".Wednesday").hide()

                $(".Thrusday").hide()

                $(".Friday").hide()

                $(".Saturday").hide()

            }

            if (day == 'Wednesday') {

                $(".Monday").hide()

                $(".Sunday").hide()

                $(".Tuesday").hide()

                $(".Wednesday").show()

                $(".Wednesday").addClass('day_circle_fill')

                $(".wednesday_start").show()

                $(".Thrusday").hide()

                $(".Friday").hide()

                $(".Saturday").hide()

            }

            if (day == 'Thursday') {

                $(".Monday").hide()

                $(".Sunday").hide()

                $(".Tuesday").hide()

                $(".Wednesday").hide()

                $(".Thrusday").show()

                $(".Thrusday").addClass('day_circle_fill')

                $(".thrusday_start").show()

                $(".Friday").hide()

                $(".Saturday").hide()

            }

            if (day == 'Friday') {

                $(".Monday").hide()

                $(".Sunday").hide()

                $(".Tuesday").hide()

                $(".Wednesday").hide()

                $(".Thrusday").hide()

                $(".Friday").show()

                $(".Friday").addClass('day_circle_fill')

                $(".friday_start").show()

                $(".Saturday").hide()

            }

            if (day == 'Saturday') {

                $(".Monday").hide()

                $(".Sunday").hide()

                $(".Tuesday").hide()

                $(".Wednesday").hide()

                $(".Thrusday").hide()

                $(".Friday").hide()

                $(".Saturday").show()

                $(".Saturday").addClass('day_circle_fill')

                $(".saturday_start").show()

            }

            if (day == 'Sunday') {

                $(".Monday").hide()

                $(".Sunday").show()

                $(".Sunday").addClass('day_circle_fill')

                $(".sunday_start").show()

                $(".Tuesday").hide()

                $(".Wednesday").hide()

                $(".Thrusday").hide()

                $(".Friday").hide()

                $(".Saturday").hide()

            }

        } else {

            $(".sunday_start").hide()

            $(".tuesday_start").hide()

            $(".wednesday_start").hide()

            $(".thrusday_start").hide()

            $(".friday_start").hide()

            $(".monday_start").hide()

            $(".saturday_start").hide()

            $(".Monday").show()

            $(".Sunday").show()

            $(".Tuesday").show()

            $(".Wednesday").show()

            $(".Thrusday").show()

            $(".Friday").show()

            $(".Saturday").show()

            if (day == 'Monday') {

                $(".Monday").show()

                $(".Monday").addClass('day_circle_fill')

                $(".monday_start").show()

            }

            if (day == 'Tuesday') {

                $(".Tuesday").show()

                $(".Tuesday").addClass('day_circle_fill')

                $(".tuesday_start").show()

            }

            if (day == 'Wednesday') {

                $(".Wednesday").show()

                $(".Wednesday").addClass('day_circle_fill')

                $(".wednesday_start").show()

            }

            if (day == 'Thursday') {

                $(".Thrusday").show()

                $(".Thrusday").addClass('day_circle_fill')

                $(".thrusday_start").show()

            }

            if (day == 'Friday') {

                $(".Friday").show()

                $(".Friday").addClass('day_circle_fill')

                $(".friday_start").show()

            }

            if (day == 'Saturday') {

                $(".Saturday").show()

                $(".Saturday").addClass('day_circle_fill')

                $(".saturday_start").show()

            }

            if (day == 'Sunday') {

                $(".Sunday").show()

                $(".Sunday").addClass('day_circle_fill')

                $(".sunday_start").show()

            }

        }

    }

});*/



function myDayFunction() {
	var day = moment($('#startingpicker').val(), 'MM-DD-YYYY').format('dddd');
	console.log("run2"+$('#frm_class_meets').val());
    if ($('#frm_class_meets').val() != 'Weekly') {
		
        if (day == 'Monday') {

            $(".Monday").show()

            $(".Monday").addClass('day_circle_fill')

            $(".monday_start").show()

            $(".Sunday").hide()

            $(".Tuesday").hide()

            $(".Wednesday").hide()

            $(".Thrusday").hide()

            $(".Friday").hide()

            $(".Saturday").hide()

        }

        if (day == 'Tuesday') {

            $(".Monday").hide()

            $(".Sunday").hide()

            $(".Tuesday").show()

            $(".Tuesday").addClass('day_circle_fill')

            $(".tuesday_start").show()

            $(".Wednesday").hide()

            $(".Thrusday").hide()

            $(".Friday").hide()

            $(".Saturday").hide()

        }

        if (day == 'Wednesday') {

            $(".Monday").hide()

            $(".Sunday").hide()

            $(".Tuesday").hide()

            $(".Wednesday").show()

            $(".Wednesday").addClass('day_circle_fill')

            $(".wednesday_start").show()

            $(".Thrusday").hide()

            $(".Friday").hide()

            $(".Saturday").hide()

        }

        if (day == 'Thursday') {

            $(".Monday").hide()

            $(".Sunday").hide()

            $(".Tuesday").hide()

            $(".Wednesday").hide()

            $(".Thrusday").show()

            $(".Thrusday").addClass('day_circle_fill')

            $(".thrusday_start").show()

            $(".Friday").hide()

            $(".Saturday").hide()

        }

        if (day == 'Friday') {

            $(".Monday").hide()

            $(".Sunday").hide()

            $(".Tuesday").hide()

            $(".Wednesday").hide()

            $(".Thrusday").hide()

            $(".Friday").show()

            $(".Friday").addClass('day_circle_fill')

            $(".friday_start").show()

            $(".Saturday").hide()

        }

        if (day == 'Saturday') {

            $(".Monday").hide()

            $(".Sunday").hide()

            $(".Tuesday").hide()

            $(".Wednesday").hide()

            $(".Thrusday").hide()

            $(".Friday").hide()

            $(".Saturday").show()

            $(".Saturday").addClass('day_circle_fill')

            $(".saturday_start").show()

        }

        if (day == 'Sunday') {

            $(".Monday").hide()

            $(".Sunday").show()

            $(".Sunday").addClass('day_circle_fill')

            $(".sunday_start").show()

            $(".Tuesday").hide()

            $(".Wednesday").hide()

            $(".Thrusday").hide()

            $(".Friday").hide()

            $(".Saturday").hide()

        }

    } else {
			
        $(".Monday").show()

        $(".Sunday").show()

        $(".Tuesday").show()

        $(".Wednesday").show()

        $(".Thrusday").show()

        $(".Friday").show()

        $(".Saturday").show()

        if (day == 'Monday') {

            $(".Monday").show()

            $(".Monday").addClass('day_circle_fill')

            $(".monday_start").show()

        }

        if (day == 'Tuesday') {

            $(".Tuesday").show()

            $(".Tuesday").addClass('day_circle_fill')

            $(".tuesday_start").show()

        }

        if (day == 'Wednesday') {

            $(".Wednesday").show()

            $(".Wednesday").addClass('day_circle_fill')

            $(".wednesday_start").show()

        }

        if (day == 'Thursday') {

            $(".Thrusday").show()

            $(".Thrusday").addClass('day_circle_fill')

            $(".thrusday_start").show()

        }

        if (day == 'Friday') {

            $(".Friday").show()

            $(".Friday").addClass('day_circle_fill')

            $(".friday_start").show()

        }

        if (day == 'Saturday') {

            $(".Saturday").show()

            $(".Saturday").addClass('day_circle_fill')

            $(".saturday_start").show()

        }

        if (day == 'Sunday') {

            $(".Sunday").show()

            $(".Sunday").addClass('day_circle_fill')

            $(".sunday_start").show()

        }

    }

}

//}
$("#b_EINnumber").keyup(function () {

    var $this = $(this);

    var input = $this.val();



    // 2

    input = input.replace(/[\W\s\._\-]+/g, '');



    // 3

    var split = 2;

    var chunk = [];



    for (var i = 0, len = input.length; i < len; i += split) {

        split = (i >= 2 && i <= 9) ? 7 : 2;

        chunk.push(input.substr(i, split));

    }



    // 4

    $this.val(function () {

        return chunk.join("-").toUpperCase();

    });

})



/*$('.day-time-div-main .timepicker').timepicker({

    timeFormat: 'h:mm p',

    interval: 30,

    startTime: '00:00',

    dynamic: true,

    dropdown: true,

    scrollbar: true,

    change: function (time) {

        if ($(this).parent().parent().children(':nth-child(3)').children().val() == '') {

            $(this).val('')

            showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select TO time without selecting from time.');

        }

    }

});*/



/*$('.day-time-div-main .sunquicktimepicker').timepicker({

    timeFormat: 'h:mm p',

    interval: 30,

    startTime: '00:00',

    dynamic: true,

    dropdown: true,

    scrollbar: true,

    change: function (time) {

        var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function () {

            return this.value; // $(this).val()

        }).get();

        console.log(sunday_start_arr)

        setTimeout(function () {

            var g = hasDuplicates(sunday_start_arr)

            console.log(g)

            if (g == true) {

                showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');

                $(".sunquicktimepicker").val('')

            }

        }, 100)

    }

});*/
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .tuesquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 30,
		startTime: '00:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		change: function (time) {
			var sunday_start_arr = $('input[name="hours[tuesday_start]"]').map(function () {
				return this.value; // $(this).val()
			}).get();
			setTimeout(function () {
				var g = hasDuplicates(sunday_start_arr)
				if (g == true) {
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
					$(".tuesquicktimepicker").val('')
				}
			}, 100)
		}	
	});
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .wedquicktimepicker').timepicker({
		timeFormat: 'h:mm p',
		interval: 30,
		startTime: '00:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true,
		change: function (time) {
			var sunday_start_arr = $('input[name="hours[wednesday_start]"]').map(function () {
				return this.value; // $(this).val()
			}).get();
			setTimeout(function () {
				var g = hasDuplicates(sunday_start_arr)
				console.log(g)
				if (g == true) {
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
					$(".wedquicktimepicker").val('')
				}
			}, 100)
		}
	});
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .thrusquicktimepicker').timepicker({
	
		timeFormat: 'h:mm p',
	
		interval: 30,
	
		startTime: '00:00',
	
		dynamic: true,
	
		dropdown: true,
	
		scrollbar: true,
	
		change: function (time) {
	
			var sunday_start_arr = $('input[name="hours[thrusday_start]"]').map(function () {
	
				return this.value; // $(this).val()
	
			}).get();
	
			setTimeout(function () {
	
				var g = hasDuplicates(sunday_start_arr)
	
				console.log(g)
	
				if (g == true) {
	
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
	
					$(".thrusquicktimepicker").val('')
	
				}
	
			}, 100)
	
		}
	
	});
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .friquicktimepicker').timepicker({
	
		timeFormat: 'h:mm p',
	
		interval: 30,
	
		startTime: '00:00',
	
		dynamic: true,
	
		dropdown: true,
	
		scrollbar: true,
	
		change: function (time) {
	
			var sunday_start_arr = $('input[name="hours[friday_start]"]').map(function () {
	
				return this.value; // $(this).val()
	
			}).get();
	
			setTimeout(function () {
	
				var g = hasDuplicates(sunday_start_arr)
	
				console.log(g)
	
				if (g == true) {
	
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
	
					$(".friquicktimepicker").val('')
	
				}
	
			}, 100)
	
		}
	
	});
}
if ( $( ".day-time-div-main" ).length ) {
	$('.day-time-div-main .satquicktimepicker').timepicker({
	
		timeFormat: 'h:mm p',
	
		interval: 30,
	
		startTime: '00:00',
	
		dynamic: true,
	
		dropdown: true,
	
		scrollbar: true,
	
		change: function (time) {
	
			var sunday_start_arr = $('input[name="hours[saturday_start]"]').map(function () {
	
				return this.value; // $(this).val()
	
			}).get();
	
			setTimeout(function () {
	
				var g = hasDuplicates(sunday_start_arr)
	
				console.log(g)
	
				if (g == true) {
	
					showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
	
					$(".satquicktimepicker").val('')
	
				}
	
			}, 100)
	
		}
	
	});
}

/*$('.day-time-div-main .monquicktimepicker').timepicker({

    timeFormat: 'h:mm p',

    interval: 30,

    startTime: '00:00',

    dynamic: true,

    dropdown: true,

    scrollbar: true,

    change: function (time) {

        var sunday_start_arr = $('input[name="hours[monday_start]"]').map(function () {

            return this.value; // $(this).val()

        }).get();

        setTimeout(function () {

            var g = hasDuplicates(sunday_start_arr)

            console.log(g)

            if (g == true) {

                showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');

                $(".monquicktimepicker").val('')

            }

        }, 100)

    }

});*/





$.fn.initialize = function () {

    //$.fn.initialize() {

    console.log(lat);

    console.log(long);
    var miles = 3;



    var map = new google.maps.Map(document.getElementById("map_canvas"), {

        zoom: 15,

        center: new google.maps.LatLng(lat, long),

        mapTypeId: google.maps.MapTypeId.ROADMAP

    });



    var circle = new google.maps.Circle({

        center: new google.maps.LatLng(lat, long),

        radius: miles * 1609.344,

        fillColor: "#ff69b4",

        fillOpacity: 0.5,

        strokeOpacity: 0.0,

        strokeWeight: 0,

        map: map

    });

}



$("label.present_work_btn").click(function () {

    $("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));

    changeDateBasedonPresent();

});



function changeDateBasedonPresent()

{

    if ($("#frm_ispresentcheck").attr("checked")) {

        $("#frm_ispresent").val("1");

        $("#dp2").val("Till Date");

        $("#dp2").attr("disabled", true);

    } else {

        $("#frm_ispresent").val("0");

        $("#dp2").val("");

        $("#dp2").attr("disabled", false);

    }

};


function options_f(len, id) {
    $('#' + id).empty();
    for (i = 1; i <= len; i++) {
        $('#' + id).append('<option value="' + i + '">' + i + '</option>');
    }
}

function options_f(len, id) {
    $('#' + id).empty();
    for (i = 1; i <= len; i++) {
        $('#' + id).append('<option value="' + i + '">' + i + '</option>');
    }
}


function firstdayweek_change_event(fval) {
    console.log(fval, "---------");
    if (fval == 'Days') {
        $('#notice').empty();
        var i = 0;
        for (i = 1; i <= 31; i++) {
            $('#notice').append('<option value="' + i + '">' + i + '</option>');
        }
    }
    if (fval == 'Weeks') {
        $('#notice').empty();
        var i = 0;
        for (i = 1; i <= 52; i++) {
            $('#notice').append('<option value="' + i + '">' + i + '</option>');
        }
    }
    if (fval == 'Months') {
        $('#notice').empty();
        var i = 0;
        for (i = 1; i <= 12; i++) {
            $('#notice').append('<option value="' + i + '">' + i + '</option>');
        }
    }
}

function seconddayweek_change_event(fval) {
    console.log(fval, "---------");
    if (fval == 'Days') {
        $('#addvance').empty();
        var i = 0;
        for (i = 1; i <= 31; i++) {
            $('#addvance').append('<option value="' + i + '">' + i + '</option>');
        }
    }
    if (fval == 'Weeks') {
        $('#addvance').empty();
        var i = 0;
        for (i = 1; i <= 52; i++) {
            $('#addvance').append('<option value="' + i + '">' + i + '</option>');
        }
    }
    if (fval == 'Months') {
        $('#addvance').empty();
        var i = 0;
        for (i = 1; i <= 12; i++) {
            $('#addvance').append('<option value="' + i + '">' + i + '</option>');
        }
    }
}
