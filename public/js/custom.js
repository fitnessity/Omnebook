! function (t) {
    "use strict";
    var e = function () {
        this.$body = t("body"), this.$wrapper = t("#wrapper"), this.$btnFullScreen = t("#btn-fullscreen"), this.$leftMenuButton = t(".button-menu-mobile"), this.$menuItem = t(".has_sub > a")
    };
    e.prototype.intSlimscrollmenu = function () {
        t(".slimscroll-menu").slimscroll({
            height: "auto",
            position: "right",
            size: "5px",
            color: "#9ea5ab",
            wheelStep: 5,
            touchScrollStep: 50
        })
    }, e.prototype.initSlimscroll = function () {
        t(".slimscroll").slimscroll({
            height: "auto",
            position: "right",
            size: "5px",
            color: "#9ea5ab",
            touchScrollStep: 50
        })
    }, e.prototype.initMetisMenu = function () {
        t("#side-menu").metisMenu()
    }, e.prototype.initLeftMenuCollapse = function () {
        t(".button-menu-mobile").on("click", function (e) {
            e.preventDefault(), t("body").toggleClass("enlarged")
        })
    }, e.prototype.initEnlarge = function () {
        t(window).width() < 1025 ? t("body").addClass("enlarged") : t("body").removeClass("enlarged")
    }, e.prototype.initActiveMenu = function () {
        t("#sidebar-menu a").each(function () {
            var e = window.location.href.split(/[?#]/)[0];
            this.href == e && (t(this).addClass("mm-active"), t(this).parent().addClass("mm-active"), t(this).parent().parent().addClass("mm-show"), t(this).parent().parent().prev().addClass("mm-active"), t(this).parent().parent().parent().addClass("mm-active"), t(this).parent().parent().parent().parent().addClass("mm-show"), t(this).parent().parent().parent().parent().parent().addClass("mm-active"))
        })
    }, e.prototype.initComponents = function () {
        t('[data-toggle="tooltip"]').tooltip(), t('[data-toggle="popover"]').popover()
    }, e.prototype.initFullScreen = function () {
        this.$btnFullScreen.on("click", function (e) {
            e.preventDefault(), document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement ? document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen && document.webkitCancelFullScreen() : document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)
        })
    }, e.prototype.init = function () {
        this.intSlimscrollmenu(), this.initSlimscroll(), this.initMetisMenu(), this.initLeftMenuCollapse(), this.initEnlarge(), this.initActiveMenu(), this.initComponents(), this.initFullScreen()
    }, t.MainApp = new e, t.MainApp.Constructor = e
}(window.jQuery),
function (e) {
    "use strict";
    window.jQuery.MainApp.init()
}();

/*$(function () {

    $('#profile').addClass('dragging').removeClass('dragging');
});

$('#profile').on('dragover', function () {
    $('#profile').addClass('dragging')
}).on('dragleave', function () {
    $('#profile').removeClass('dragging')
}).on('drop', function (e) {
    $('#profile').removeClass('dragging hasImage');

    if (e.originalEvent) {
        var file = e.originalEvent.dataTransfer.files[0];
        console.log(file);

        var reader = new FileReader();

        //attach event handlers here...

        reader.readAsDataURL(file);
        reader.onload = function (e) {
            console.log(reader.result);
            $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');

        }

    }
})
$('#profile').on('click', function (e) {
    console.log('clicked')
    $('#mediaFile').click();
});
window.addEventListener("dragover", function (e) {
    e = e || event;
    e.preventDefault();
}, false);
window.addEventListener("drop", function (e) {
    e = e || event;
    e.preventDefault();
}, false);
$('#mediaFile').change(function (e) {

    var input = e.target;
    if (input.files && input.files[0]) {
        var file = input.files[0];

        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = function (e) {
            console.log(reader.result);
            $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');
        }
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-upload-wrap').hide();

            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();

            $('.image-title').html(input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);

    } else {
        removeUpload();
    }
}

function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});*/

$("#viewmore").click(function () {
    $(".middletoday").addClass("intro");
    $("#viewless").show();
    $("#viewmore").hide();
});

$("#viewless").click(function () {
    $(".middletoday").removeClass("intro");
    $("#viewless").hide();
    $("#viewmore").show();
});

$("#viewmore1").click(function () {
    $(".middletoday1").addClass("intro1");
    $("#viewless1").show();
    $("#viewmore1").hide();
});

$("#viewless1").click(function () {
    $(".middletoday1").removeClass("intro1");
    $("#viewless1").hide();
    $("#viewmore1").show();
});


$(".viewpend").click(function () {
    $(".middlepending").addClass("intro2");
    $(".lesspend").show();
    $(".viewpend").hide();
});

$(".lesspend").click(function () {
    $(".middlepending").removeClass("intro2");
    $(".lesspend").hide();
    $(".viewpend").show();
});

$(".viewpend1").click(function () {
    $(".middlepending1").addClass("intro3");
    $(".lesspend1").show();
    $(".viewpend1").hide();
});

$(".lesspend1").click(function () {
    $(".middlepending1").removeClass("intro3");
    $(".lesspend1").hide();
    $(".viewpend1").show();
});


$(".viewcomp").click(function () {
    $(".middlecomp").addClass("intro4");
    $(".lesscomp").show();
    $(".viewcomp").hide();
});

$(".lesscomp").click(function () {
    $(".middlecomp").removeClass("intro4");
    $(".lesscomp").hide();
    $(".viewcomp").show();
});

$(".viewcomp1").click(function () {
    $(".middlecomp1").addClass("intro5");
    $(".lesscomp1").show();
    $(".viewcomp1").hide();
});

$(".lesscomp1").click(function () {
    $(".middlecomp1").removeClass("intro5");
    $(".lesscomp1").hide();
    $(".viewcomp1").show();
});


$(".viewcan").click(function () {
    $(".middlecan").addClass("intro6");
    $(".lesscan").show();
    $(".viewcan").hide();
});

$(".lesscan").click(function () {
    $(".middlecan").removeClass("intro6");
    $(".lesscan").hide();
    $(".viewcan").show();
});

$(".viewcan1").click(function () {
    $(".middlecan1").addClass("intro7");
    $(".lesscan1").show();
    $(".viewcan1").hide();
});

$(".lesscan1").click(function () {
    $(".middlecan1").removeClass("intro7");
    $(".lesscan1").hide();
    $(".viewcan1").show();
});


