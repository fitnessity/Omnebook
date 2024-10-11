function favourite(id, type) {
    $.ajax({
        type: "POST",
        data: {
            fav_user_id: id,
            type: type
        },
        url: "/isfavourite",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response);
            var html = "";
            var selectetype;

            if (response.type === 'success') {
                if (type == "favourite") {
                    selectetype = "unfavourite";
                    html += '<a onclick="favourite(' + id + ',\'' + selectetype + '\')" class="removefavourite_' + id + '"><i class="fa fa-star fav-star"></i></a>';

                    $('#userFavourite_' + id).html('');
                    $('#userFavourite_' + id).append(html);

                } else {
                    $('#favouriteblock_' + id).html('');
                    selectetype = "favourite";
                    html += '<a onclick="favourite(' + id + ',\'' + selectetype + '\')" class="makefavourite_' + id + '"><i class="fa fa-star-o unfav-star"></i></a>';
                    $('#userFavourite_' + id).html('');
                    $('#userFavourite_' + id).append(html);
                }

                $('#follow-msg').addClass('alert-success');
                $('#follow-msg').css('display', 'block').html(response.msg);
                $('#systemMessage_network').addClass('alert-success');
                $('#systemMessage_network').html(response.msg);
            }

            if (response.type === 'danger') {

                $('#follow-msg').addClass('alert-danger');
                $('#follow-msg').css('display', 'block').html(response.msg);
                $('#systemMessage_network').addClass('alert-success');
                $('#systemMessage_network').html(response.msg);
            }

            setTimeout(function () {
                $('#follow-msg').removeClass('alert-success');
                $('#follow-msg').removeClass('alert-danger');
                $('#follow-msg').css('display', 'none');
                $('#systemMessage_network').removeClass('alert-success');
                $('#systemMessage_network').html("");
            }, 2000);

            if (response.data == 'unfavourite') {
                $('.favouriteblock_' + id).remove();
            }

            // return false;

            // var html="";
            // var selectetype;
            // if(type == "favourite")
            // {
            //     selectetype = "unfavourite";
            //      html +='<a onclick="favourite(' + id + ',\'' + selectetype + '\')" class="removefavourite_'+id+'"><i class="fa fa-star" style="font-size: 28px;color:#f53b49;padding-top: 8px;"></i></a>';

            //     $('#userFavourite_'+id).html('');
            //     $('#userFavourite_'+id).append(html);

            // }
            // else
            // {
            //     $('#favouriteblock_'+id).html('');
            //     selectetype = "favourite";
            //     html +='<a onclick="favourite(' + id + ',\'' + selectetype + '\')" class="makefavourite_'+id+'"><i class="fa fa-star-o" style="font-size: 28px !important;padding-top: 8px;"></i></a>';
            //     $('#userFavourite_'+id).html('');
            //     $('#userFavourite_'+id).append(html);
            // }
        }
    });
}

function showSystemMessages(wrapper, type, msg, showcloseBtn) {

    if (typeof toastr !== 'undefined') {
        toastr.clear();

        var ts = toastr;
        ts.options.closeButton = true;
        ts.options.positionClass = 'toast-top-right';
        ts.options.preventDuplicates = true;

        switch (type) {
            case 'success':
                ts.success(msg);
                break;
            case 'info':
                ts.info(msg);
                break;
            case 'warning':
                ts.warning(msg);
                break;
            case 'danger':
                ts.error(msg);
                break;
        }

    } else {

        var msgExclamation = '';
        showcloseBtn = typeof showcloseBtn == undefined ? true : showcloseBtn;
        switch (type) {
            case 'success':
                msgExclamation = 'Well Done';
                break;
            case 'info':
                msgExclamation = 'Heads Up';
                break;
            case 'warning':
                msgExclamation = 'Warning';
                break;
            case 'danger':
                msgExclamation = 'Oh Snap';
                break;
        }

        var htmlMsgs = {};
        var btnHtml = showcloseBtn ? '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' : '';
        var htmlMsgs = '<div class="alert alert-' + type + ' alert-dismissible" role="alert"> ' + btnHtml + '<strong>' + msgExclamation + '!</strong> ' + msg + '</div>';

        $(wrapper).html(htmlMsgs);
        var body = $("html, body");
        body.stop().animate({
            scrollTop: $(wrapper).offset().top - 25
        }, '500');

    }


};

function user_notice(type, msg) {
    $.fn.noop = function () {
        return this;
    };

    var appToast = customtoastr;
    appToast.options.hideMethod = 'noop';
    appToast.options.closeButton = false;
    appToast.options.positionClass = 'toast-bottom-left';
    appToast.options.preventDuplicates = true;

    switch (type) {
        case 'success':
            appToast.success(msg, {
                timeout: 0
            });
            break;
        case 'info':
            appToast.info(msg, {
                timeout: 0
            });
            break;
        case 'warning':
            appToast.warning(msg, {
                timeout: 0
            });
            break;
        case 'danger':
            appToast.error(msg, {
                timeout: 0
            });
            break;
    }
};

(function ($) {
    $.fn.menumaker = function (options) {
        var cssmenu = $(this),
            settings = $.extend({
                format: "dropdown",
                sticky: false
            }, options);
        return this.each(function () {
            $(this).find(".button").on('click', function () {
                $(this).toggleClass('menu-opened');
                var mainmenu = $(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.slideToggle().removeClass('open');
                } else {
                    mainmenu.slideToggle().addClass('open');
                    if (settings.format === "dropdown") {
                        mainmenu.find('ul').show();
                    }
                }
            });
            cssmenu.find('li ul').parent().addClass('has-sub');
            multiTg = function () {
                cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                cssmenu.find('.submenu-button').on('click', function () {
                    $(this).toggleClass('submenu-opened');
                    if ($(this).siblings('ul').hasClass('open')) {
                        $(this).siblings('ul').removeClass('open').slideToggle();
                    } else {
                        $(this).siblings('ul').addClass('open').slideToggle();
                    }
                });
            };
            if (settings.format === 'multitoggle') multiTg();
            else cssmenu.addClass('dropdown');
            if (settings.sticky === true) cssmenu.css('position', 'fixed');
            resizeFix = function () {
                var mediasize = 1000;
                if ($(window).width() > mediasize) {
                    cssmenu.find('ul').show();
                }
                if ($(window).width() <= mediasize) {
                    cssmenu.find('ul').hide().removeClass('open');
                }
            };
            resizeFix();
            return $(window).on('resize', resizeFix);
        });
    };
})(jQuery);

(function ($) {
    $(document).ready(function () {
        $("#cssmenu").menumaker({
            format: "multitoggle"
        });
    });
})(jQuery);

removeClass = false;
$(".login_links").click(function () {
    $(".dropdown_login").toggleClass('open');
    removeClass = false;
});
$(".dropdown_login").click(function () {
    removeClass = false;
});
$("html").click(function () {
    if (removeClass) {
        $(".dropdown_login").removeClass('open');
    }
    removeClass = true;
});
