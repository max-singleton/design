$(document).ready(function () {
    $(".content__padding").prepend($(".home-adress").remove());
    $(".breadcrumbs").html("");
    $(".subpage .page-title").remove();
    var result = [];
    var offset_items = [];
    var iter = 0;
    h_doc = $(document).height() - $("#footer").outerHeight(true) - $("#bottom-menu").outerHeight(true);
    $(".subsection").addClass("main-border");
    $("#work h2").addClass('main-border');
    $("#menu-area").wrap('<div class="menu-area"></div>');

    var menuarea = $(".menu-area");
    var menu = $(".menu");
    menu.after('<div class="bgfon"></div>');
    var topHouseInfo = $(".head-info").height() + $(".top-line").height() + $(".menu").height();
    $('h2').each(function () {
        obj = {};
        obj.offset = $(this).offset().top - topHouseInfo;
        obj.html = $(this).text();
        obj.index = iter;
        result.push(obj);
        $('#menu-area').html($('#menu-area').html() + "<div id='menu_" + iter + "'>" + result[iter].html + "</div>");
        $('#menu-area ' + '#menu_' + iter).addClass("menu-item");
        offset_items.push(20 + 80 * iter);
        iter++;
    });
    $('#menu-area').html($('#menu-area').html() + "<div id='image-focused' class='main-bg'></div><div id='border_left' class='main-bg'></div><div class='clearfix'></div>");
    $("#border_left").css("height", (20 + 80 * result.length) + "px"); //height of left border
    $("#border_left").css("margin-bottom", $("#footer").outerHeight(true) + $("#bottom-menu").outerHeight(true))
    for (var iter1 = 0; iter1 < $("#border_left").height(); iter1 = iter1 + 20) { //form left border
        if (offset_items.indexOf(iter1) == -1) {
            $("#border_left").html($("#border_left").html() + "<img class='border_image' src='" + componentPath + "/images/menu-icons/not_used_item.png'>");
        } else {
            $("#border_left").html($("#border_left").html() + "<img class='border_image' src='" + componentPath + "/images/menu-icons/used_item.png'>");
        }
    }
    ;
    $("#menu-area #menu_0").addClass("main");
    $("#work").css("padding-left", '230px');
    var image = $('#image-focused');
    image.html("<img src='" + componentPath + "/images/menu-icons/0.png'>");
    work_margin = $(window).height() - $("#footer").outerHeight(true) - $("#bottom-menu").outerHeight(true);
    var element = $("#work").children().last();
    work_margin = work_margin - element.outerHeight(true);
    element = element.prev();
    work_margin = work_margin - element.outerHeight(true);
    work_margin = Math.max(work_margin, $("#border_left").height());
    $('#image-focused').html("<img src='" + componentPath + "/images/menu-icons/0.png'>");
    $("#work").css("margin-bottom", work_margin);
    var pageHouseInfo = $(".page-house-info");
    $('.menu-item').click(function () {
        $("body, html").animate({scrollTop: result[($(this).attr('id')).split('_')[1]].offset}, '500', 'swing');
        var menuItem = $(this);
        window.setTimeout(function () {
            $("#menu-area div").removeClass("main");
            var id = (menuItem.attr('id')).split('_')[1];
            $("#menu-area div:contains(" + result[id].html + ")").addClass("main");
            image.css('top', offset_items[id] - image.height() / 2 + "px");
        }, 300);
    });
    var footer = $(".cabinet.cont-p");
    if (footer.length == 0) {
        footer = $("footer");
    }
    else {
        $(".content.page-desktop-height").after(footer);
    }
    var homeAddress = $(".home-adress");

    function setPositionFixPage() {
        var border_left = $("#border_left");
        var windowScrollTop = $(window).scrollTop();
        var pageTop = menu.offset().top + menu.height() - windowScrollTop + 10;
        homeAddress.css("top", pageTop);
        menuarea.css("top", pageTop + 100);
        if (border_left.length == 1) {
            var zazor = footer.offset().top - border_left.offset().top - Math.max(Math.min(450, pageHouseInfo.height()), border_left.height()) - 10;
            if (zazor < 0) {
                pageTop += zazor;
                homeAddress.css("top", pageTop);
                menuarea.css("top", pageTop + 100);
            }
        }
        homeAddress.css("top", pageTop);
        menuarea.css("top", pageTop + 100);
    }

    jQuery(window).scroll(setPositionFixPage);
    setPositionFixPage();
    var elem = $('#menu-area');
    var atop = $(window).scrollTop();
    $(window).scroll(function () {
        atop = $(this).scrollTop();
        if ((atop > 0)) {
            if (atop + $("#border-left").height() > h_doc) {
                elem.css("top", -((atop + $("#border-left").height()) - h_doc));
            }
            else {
                elem.css("top", 0);
            }
        } else {
            elem.css("top", -atop);
        }
        if (atop > 0) { // обрабатываем прокрутку
            var min = result[0];
            var image = $('#image-focused');

            result.forEach(function (res) {
                if (atop > res.offset) {
                    min = res;
                }
                if (result.length > min.index + 1 && atop > (min.offset + (result[min.index + 1].offset - min.offset) * 0.75)) {
                    min = result[min.index + 1];
                }
            });
            $("#menu-area div").removeClass("main");
            $("#menu-area div:contains(" + min.html + ")").addClass("main");
            image.css('top', offset_items[min.index] - image.height() / 2 + "px");
        }
    });
    $(".home-adress a").after(" " + arResult.EP_ADDRESS);
    $(".home-adress a img").attr("src", templatePath + "/images/arrow.png");
    $(".home-adress a img").addClass("main-bg");
    $(".home-adress a img").addClass("arrow-back");
    $(".home-adress").addClass("fix-desktop");
    pageHouseInfo.find(".section .bordered").wrap('<div class="mobi-overflow"></div>');

});