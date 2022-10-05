/// <reference path="jquery-1.12.3.js" />

(function ($) {

    var list = [];

    /* function to be executed when product is selected for comparision*/
    $(document).on('click', '.closeItems', function () {
        list = [];
        $(".comparePanle").hide();
        location.reload();
    });

    $(document).on('click', '.addToCompare', function () {
        $(".comparePanle").show();
        //$(this).toggleClass("rotateBtn");
        $(this).parents(".selectProduct").toggleClass("selected");
        var productID = $(this).parents('.selectProduct').attr('data-id');
        var inArray = $.inArray(productID, list);
        if (inArray < 0) {
            if (list.length > 2) {
                $("#WarningModal").show();
                $("#warningModalClose").click(function () {
                    $("#WarningModal").hide();
                });
                //$(this).toggleClass("rotateBtn");
                $(this).parents(".selectProduct").toggleClass("selected");
                return;
            }
            if (list.length < 3) {
                list.push(productID);
                var displayTitle = $(this).parents('.selectProduct').attr('data-name');
                // var image = $(this).siblings(".productImg").attr('src');
                /*var image = $(this).parents('.selectProduct').find(".productImg").attr('src');*/
                var image = $(this).parents('.selectProduct').attr('data-img');
					/*alert(image);*/
                $(".comparePan").append('<div id="' + productID + '" class="relPos titleMargin w3-margin-bottom   w3-col l3 m4 s4"><div class="titleMargin"><a class="selectedItemCloseBtn w3-closebtn cursor">&times</a><img src="' + image + '" alt="image" style="height:100px; padding:10px; width: 100px;"/><p id="' + productID + '" class="topmargin10">' + displayTitle + '</p></div></div>');
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
	
    $(document).on('click', '.cmprBtn', function () { //alert('call');
	
			var imagtd = "";
            var bookinglink = "";
            var nametd = "";
            var companytd = "";
            var companyvertd = "";
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
        if ($(".cmprBtn").hasClass("active")) {
			$(".comparePanle").hide();
			$(".compare-records-div").html('');
			$(".compare-records-div").append('<table>');
			var setHtml = '<table>';
			var professional_ids = new Array();
			for (var i = 0; i < list.length; i++) {
				product = $('.selectProduct[data-id="' + list[i] + '"]');
				professional_ids[i] = $(product).data('id');
			}
			var professional_ids_str = professional_ids.join(",");
			var sethtml ='';
			$.ajax({
				url:'instant-hire/getCompareProfessionalDetail/'+professional_ids_str,
				type:'GET',
				dataType: 'json',
				beforeSend: function () {
				},
				complete: function () {
				},
				success: function (response) { //alert(response);
					//console.log('RES=',response);
					//console.log(list);
					//$('.contentPop').empty();
					$('body').find('.compare-records-div table').html('');
					var w = 2;
					if(list.length == 2){
						w = 5;
					}
					else if(list.length == 3){
						w = 3;
					}
						
					var tablecolumn = parseInt(list.length);
					var columnwidth = (85 / parseInt(tablecolumn)).toFixed(2);
				
					setHtmldd = '';
					setHtml = '';
					$.each( response.data, function( key, value ) {
						var img = $('.selectProduct[data-id="' + value + '"]').attr('data-img');
						
						var name = $('.selectProduct[data-id="' + value + '"]').attr('data-name');
						var price = $('.selectProduct[data-id="' + value + '"]').attr('data-price');
						
						if(key == 'image_pic'){
							setHtml += '<tr>';
							setHtml += '<th style="background:#fff;">&nbsp;</th>';
							$.each( value, function( k, v ) {
								var img = $('.selectProduct[data-id="' + k + '"]').attr('data-img');
								setHtml += '<td style="border-right: none !important;text-align: center;"><img src="'+img+'" style="height:140px; width:180px;"</></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'program_name'){
							setHtml += '<tr>';
							setHtml += '<th><h3>Program Name</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v!='')?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						if(key == 'description'){
							setHtml += '<tr>';
							setHtml += '<th><h3>Description</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v!='')?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						if(key == 'sport_activity'){
							setHtml += '<tr>';
							setHtml += '<th><h3>Activity Type</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v!='')?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'reviews'){
							setHtml += '<tr>';
							setHtml += '<th><h3>Reviews</h3></th>';
							$.each( value, function( k, v ) {
								/*alert(k);
								alert(v);*/
								setHtml += '<td><p style="color: #ff3459;">'+((v!='')?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'price'){
							setHtml += '<tr>';
							setHtml += '<th><h3>Price Range</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v!='')?v:'')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'address'){
							setHtml += '<tr>';
							setHtml += '<th><h3>State,City,Zip Code</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v!='')?v:'')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'business_name'){
							setHtml += '<tr>';
							setHtml += '<th><h3>Business Name</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v!='')?v:'')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'business_verified'){
							setHtml += '<tr>';
							setHtml += '<th><h3>Business Verified</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>-</p></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'background_checked'){
							setHtml += '<tr>';
							setHtml += '<th><h3>Background Checked</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>-</p></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'offers_services_to'){ 
							setHtml += '<tr>';
							setHtml += '<th><h3>Offers Services To</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v)?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						if(key == 'other_activities_offerd'){ 
							setHtml += '<tr>';
							setHtml += '<th><h3>Other Activities Offerd</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v)?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						if(key == 'instructor_habit'){ 
							setHtml += '<tr>';
							setHtml += '<th><h3>Personality of Instructor</th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v)?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						if(key == 'type_of_service'){ 
							setHtml += '<tr>';
							setHtml += '<th><h3>Type Of Service</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v)?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'location_of_service'){ 
							setHtml += '<tr>';
							setHtml += '<th><h3>Location Of Service</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v)?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						
						if(key == 'experience_of_activity'){ 
							setHtml += '<tr>';
							setHtml += '<th><h3>Experience Of Activity</h3></th>';
							$.each( value, function( k, v ) {
								setHtml += '<td><p>'+((v)?v:'-')+'</p></td>';
							});
							setHtml += '</tr>';
						}
						if(key == 'details_button'){ 
							setHtml += '<tr>';
							setHtml += '<th>&nbsp;</th>';
							$.each( value, function( k, v ) {
								setHtml += '<td style="text-align: center;"><a class="showall-btn" href="/activity-details/'+k+'">More Details</a> </td>';
							});
							setHtml += '</tr>';
						}
					});	
					$(".compare-records-div table").html(setHtml);				
				}
			});	
		}
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
        //$(".rotateBtn").toggleClass("rotateBtn");
        $('.addToCompare').removeClass('active-link');
        $('.addToCompare').html('+ Add to Compare');
        $('.addToCompare').attr('title', 'Add to Compare');
    });

    /* function to remove item from preview panel */
    $(document).on('click', '.selectedItemCloseBtn', function () {
        var test = $(this).siblings("p").attr('id');
        //$('[data-title=' + test + ']').find(".addToCompare").click();
		$('#compid'+test).click();
        hideComparePanel();
    });

    function hideComparePanel() {
        if (!list.length) {
            $(".comparePan").empty();
            $(".comparePanle").hide();
        }
    }
	
	/*$(document).on('click', '.compdetailclose', function () {
		alert('call');
		list = [];
		//$("#myModal").hide();
		$("#myModal").modal('toggle');
		//$(".compare-model").modal('hide');
	});*/
	
	$(document).on('click', '.clear_compare_list', function () {
		list = [];
		//$("#myModal").hide();
		
        $(".comparePanle").hide();
        location.reload();
		
		//$(".compare-model").modal('hide');
	});
})(jQuery);