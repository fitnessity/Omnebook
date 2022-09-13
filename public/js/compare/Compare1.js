/// <reference path="jquery-1.12.3.js" />

(function ($) {
    var list = [];

    /* function to be executed when product is selected for comparision*/

    $(document).on('click', '.addToCompare', function () {
        $(".comparePanle").show();
        $(this).toggleClass("rotateBtn");
        $(this).parents(".selectProduct").toggleClass("selected");
        var productID = $(this).parents('.selectProduct').attr('data-title');

        var inArray = $.inArray(productID, list);
        if (inArray < 0) {
            if (list.length > 2) {
                $("#WarningModal").show();
                $("#warningModalClose").click(function () {
                    $("#WarningModal").hide();
                });
                $(this).toggleClass("rotateBtn");
                $(this).parents(".selectProduct").toggleClass("selected");
                return;
            }

            if (list.length < 3) {
                list.push(productID);

                var displayTitle = $(this).parents('.selectProduct').attr('data-name');

                // var image = $(this).siblings(".productImg").attr('src');
                var image = $(this).parents('.selectProduct').find(".productImg").attr('src');

                $(".comparePan").append('<div id="' + productID + '" class="relPos titleMargin w3-margin-bottom   w3-col l3 m4 s4"><div class="titleMargin"><a class="selectedItemCloseBtn w3-closebtn cursor">&times</a><img src="' + image + '" alt="image" style="height:100px;"/><p id="' + productID + '" class="topmargin10">' + displayTitle + '</p></div></div>');

                // change add to compare text
                $(this).addClass('active-link');
                $(this).html('Added to Compare');
                $(this).attr('title', 'Click here again to Remove from Compare');
            }
        } else {
            list.splice($.inArray(productID, list), 1);
            var prod = productID.replace(" ", "");
            $('#' + prod).remove();
            hideComparePanel();

            $(this).removeClass('active-link');
            $(this).html('+ Add to Compare');
            $(this).attr('title', 'Add to Compare');
            
        }
        if (list.length > 1) {
            $(".cmprBtn").addClass("active");
            $(".cmprBtn").removeAttr('disabled');
        } else {
            $(".cmprBtn").removeClass("active");
            $(".cmprBtn").attr('disabled', '');
        }

    });
    /*function to be executed when compare button is clicked*/
    $(document).on('click', '.cmprBtn', function () {
        if ($(".cmprBtn").hasClass("active")) {
            /* this is to print the  features list statically*/
            // $(".contentPop").append(
            //     '<div class="w3-col s3 m3 l3 compareItemParent relPos">' 
            //     + '<ul class="product">' 
            //     + ' <li class=" relPos compHeader"><p class="w3-display-middle">Features</p></li>' 
            //     + ' <li>&nbsp;</li>'
            //     + ' <li>Name</li>' 
            //     + ' <li>Company Name</li>' 
            //     + ' <li>Professional Type</li>' 
            //     + ' <li>Email</li>' 
            //     + ' <li>State</li>' 
            //     + ' <li>Experience Level</li>'
            //     + ' <li>Provides training to</li>'
            //     + ' <li>Personality</li>'
            //     + ' <li>Sports</li>'
            //     + ' <li>Certifications</li>'
            //     + ' <li>Services Offers</li>'
            //     + ' <li>Availability</li>'
            //     + ' <li>Willing To Travel</li>'
            //     // + ' <li>Travel Miles</li>'                
            //     + '</ul>' 
            //     + '</div>');
            //$(".contentPop").append('<table compareItemParent relPos">');
            var imagtd = "";
            var bookinglink = "";
            var nametd = "";
            var companytd = "";
            var proftype = "";
            var emailtd = "";
            var statetd = "";
            var exptd = "";
            var traintd = "";
            var personalitytd = "";
            var sporttd = "";
            var certitd = "";
            var servicetd = "";
            var availtd = "";
            var travel = "";

            //get profile detail
            var professional_ids = new Array();
            for (var i = 0; i < list.length; i++) {
                product = $('.selectProduct[data-title="' + list[i] + '"]');
                professional_ids[i] = $(product).data('id');
            }
            var professional_ids_str = professional_ids.join(",");

            $.ajax({
                  url:'direct-hire/getCompareProfessionalDetail/'+professional_ids_str,
                  type:'GET',
                  dataType: 'json',
                  beforeSend: function () {
                  },
                  complete: function () {
                  },
                  success: function (response) {
                    var tablecolumn = parseInt(list.length);
                    var columnwidth = (85 / parseInt(tablecolumn)).toFixed(2);
                    for (var i = 0; i < list.length; i++) {
                        /* this is to add the items to popup which are selected for comparision */
                        product = $('.selectProduct[data-title="' + list[i] + '"]');
                        var profile_detail = response.data['profile_'+$(product).data('id')];
                        var image = $('.selectProduct[data-title="' + list[i] + '"]').find(".productImg").attr('src');
                        var name = $('.selectProduct[data-title="' + list[i] + '"]').attr('data-id');
                        /*appending to div*/
                        // var html = '<div class="w3-col s3 m3 l3 compareItemParent relPos">' 
                        //     + '<ul class="product">' 
                        //     + ' <li class="compHeader"><img src="' + image + '" class="compareThumb">' + '</li>' 
                        //     + ' <li>' + '<a href="/directhire/bookprofile/'+$(product).data('id')+'" class="book-professional-link">BOOK THIS PROFESSIONAL</a>' + '</li>'
                        //     + ' <li>' + $(product).data('name') + ' ('+ $(product).data('gender') +')' + '</li>' 
                        //     + ' <li>' + $(product).data('companyname') + '</li>' 
                        //     + ' <li>' + profile_detail.professional_type + '</li>' 
                        //     + ' <li>' + $(product).data('email') 
                        //     + ' <li>' + $(product).data('address') + '</li>' 
                        //     + ' <li>' + profile_detail.explevel + '</li>'
                        //     + ' <li>' + profile_detail.train_to + '</li>'
                        //     + ' <li>' + profile_detail.personality + '</li>'
                        //     + ' <li>' + profile_detail.sport + '</li>'
                        //     + ' <li>' + profile_detail.certification + '</li>'
                        //     + ' <li>' + profile_detail.service + '</li>'
                        //     + ' <li>' + profile_detail.availability + '</li>'

                        //     + ' <li>' + profile_detail.willing_to_travel;
                            // + ' <li>' + profile_detail.travel_miles + '</li>'
                        // if(profile_detail.willing_to_travel == "Yes")
                        //     html += ', ' + profile_detail.travel_miles + ' Miles';

                        // html += '</li>';
                        // html +=  '</ul>' 
                        //     + '</div>';

                        //$(".contentPop").append(html);
                        
                        imagtd += ' <td class="compHeader"><img src="' + image + '" class="compareThumb"></td>' ;
                        bookinglink += '<td>' + '<a href="/directhire/bookprofile/'+$(product).data('id')+'" class="book-professional-link">BOOK THIS PROFESSIONAL</a>' + '</td>'; 
                        nametd += ' <td>' + $(product).data('name') + '('+ $(product).data('gender') +')' + '</td>';
                        companytd += ' <td>' + $(product).data('companyname') + '</td>' ;
                        proftype += '<td>' + profile_detail.professional_type + '</td>'; 
                        emailtd += ' <td>' + $(product).data('email') + '</td>';
                        statetd += ' <td>' + $(product).data('address') + '</td>'; 
                        exptd += ' <td>' + profile_detail.explevel + '</td>';
                        traintd += ' <td>' + profile_detail.train_to + '</td>';
                        personalitytd += ' <td>' + profile_detail.personality + '</td>';
                        sporttd += ' <td>' + profile_detail.sport + '</td>';
                        certitd += ' <td>' + profile_detail.certification + '</td>';
                        servicetd += ' <td>' + profile_detail.service + '</td>';
                        availtd += ' <td>' + profile_detail.availability + '</td>';
                        travel += '<td>' + profile_detail.willing_to_travel;
                        if(profile_detail.willing_to_travel == "Yes")
                            travel += ', ' + profile_detail.travel_miles + ' Miles';
                        travel += '</td>';
                        
                    }

                    $(".contentPop").append('<table class="compareItemParent relPos comparetable" border="1">'
                        + '<tr><th width="15%">&nbsp;</th><th width="'+columnwidth+'%">&nbsp;</th><th width="'+columnwidth+'%">&nbsp;</th></tr>'
                        + '<tr>' + '<td>Features</td>' + imagtd + '</tr>'
                        + '<tr>' + '<td>&nbsp;</td>' + bookinglink + '</tr>'
                        + '<tr>' + '<td>Name</td>' + nametd + '</tr>'
                        + '<tr>' + '<td>Company Name</td>' + companytd + '</tr>'
                        + '<tr>' + '<td>Email</td>' + emailtd + '</tr>'
                        + '<tr>' + '<td>State</td>' + statetd + '</tr>'
                        + '<tr>' + '<td>Experience Level</td>' + exptd + '</tr>'
                        + '<tr>' + '<td>Provides training to</td>' + traintd + '</tr>'
                        + '<tr>' + '<td>Personality</td>' + personalitytd + '</tr>'
                        + '<tr>' + '<td>Sports</td>' + sporttd + '</tr>'
                        + '<tr>' + '<td>Certifications</td>' + certitd + '</tr>'
                        + '<tr>' + '<td>Services Offers</td>' + servicetd + '</tr>'
                        + '<tr>' + '<td>Availability</td>' + availtd + '</tr>'
                        + '<tr>' + '<td>Willing To Travel</td>' + availtd + '</tr>'
                        + '</table>');
                  }
            });

            // for (var i = 0; i < list.length; i++) {
            //     /* this is to add the items to popup which are selected for comparision */
            //     product = $('.selectProduct[data-title="' + list[i] + '"]');
            //     var image = $('[data-title=' + list[i] + ']').find(".productImg").attr('src');
            //     var name = $('[data-title=' + list[i] + ']').attr('data-id');
            //     /*appending to div*/
            //     $(".contentPop").append(
            //         '<div class="w3-col s3 m3 l3 compareItemParent relPos">' 
            //         + '<ul class="product">' 
            //         + ' <li class="compHeader"><img src="' + image + '" class="compareThumb"></li>' 
            //         + ' <li>' + $(product).data('name') + '('+ $(product).data('companyname') +')' + '</li>' 
            //         + ' <li>' + $(product).data('companyname') + '</li>' 
            //         + ' <li>' + $(product).data('email') 
            //         + ' <li>' + $(product).data('address') + '</li>' 
            //         + ' <li>' + $(product).data('explevel') + '</li>'
            //         + ' <li>' + $(product).data('trainingto') + '</li>'
            //         + ' <li>' + $(product).data('availability') + '</li>'
            //         + ' <li>' + $(product).data('services') + '</li>'
            //         + '</ul>' 
            //         + '</div>');
            // }
        }
        $(".modPos").show();
    });

    /* function to close the comparision popup */
    $(document).on('click', '.closeBtn', function () {
        $(".contentPop").empty();
        $(".comparePan").empty();
        $(".comparePanle").hide();
        $(".modPos").hide();
        $(".selectProduct").removeClass("selected");
        $(".cmprBtn").attr('disabled', '');
        list.length = 0;
        $(".rotateBtn").toggleClass("rotateBtn");

        $('.addToCompare').removeClass('active-link');
        $('.addToCompare').html('+ Add to Compare');
        $('.addToCompare').attr('title', 'Add to Compare');
    });

    /*function to remove item from preview panel*/
    $(document).on('click', '.selectedItemCloseBtn', function () {

        var test = $(this).siblings("p").attr('id');
        $('[data-title=' + test + ']').find(".addToCompare").click();
        hideComparePanel();
    });

    function hideComparePanel() {
        if (!list.length) {
            $(".comparePan").empty();
            $(".comparePanle").hide();
        }
    }
})(jQuery);