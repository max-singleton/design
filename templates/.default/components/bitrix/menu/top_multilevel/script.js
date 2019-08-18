$(document).ready(function() {
    var menuTop = $('.menu');
    var parentMenuTop = menuTop.parent();
    if(parentMenuTop[0].tagName == "DIV" && parentMenuTop[0].id != null && parentMenuTop[0].id.indexOf("bx_incl_area") == 0){
        var breadcrumbs = parentMenuTop.find(".breadcrumbs");
        if(breadcrumbs.length == 1){
            breadcrumbs.appendTo($('header'));
        }
    }

	$('.menu-mobi__image, .menu-mobi__text').on('click', function(){
		if ($('.menu__item').is(':visible')) 
		{
			$('.menu__item').removeClass("menu__item-show");
		}
		else
		{
			$('.menu__item').addClass("menu__item-show");
		}
	});

	var menulink = $('.menu__link');
	menulink.each(function(){
		if($(this).siblings('.dropdown-menu').length)
		{
			$(this).addClass("menu__link_none");
		}
	});

	//Меню аккордеон как во втором варианте  http://siteis.ru/index.php?option=com_content&view=article&id=189
	var buff;
	$('.menu__link').on('click', function(){

		if ($(this).siblings('.dropdown-menu').length && $(this).siblings('.dropdown-menu').is(':visible'))
		{
			$(this).siblings('.dropdown-menu').removeClass("dropdown-menu__item-show");
			$(this).removeClass("menu__link_click");
			$(this).addClass("menu__link_none");
		}
		else if($(this).siblings('.dropdown-menu').length && $(this).siblings('.dropdown-menu').is(':hidden'))
		{
			$('.menu__link').siblings('.dropdown-menu').removeClass("dropdown-menu__item-show");
            buff = $(".menu__link_click");
			buff.addClass('menu__link_none');
			buff.removeClass("menu__link_click");
			$(this).siblings('.dropdown-menu').addClass("dropdown-menu__item-show");
			$(this).removeClass("menu__link_none");
			$(this).addClass("menu__link_click");
		}
	});
    var menuTop = $('.menu'), headInfo = $('.head-info');
    var menuTopTop1 = menuTop.css('top');
	var breadcrumbs = $('.breadcrumbs');

    function setPositionMenu(){
        var offsetp = window.pageYOffset;
        if (typeof offsetmenu == "undefined") offsetmenu = document.getElementsByClassName("menu")[0].offsetTop;

        if(offsetp >= offsetmenu ) {
            document.getElementById('menu_top').className = "menu_sticky"
            $('.menu_sticky').css('width', $('body').width());
        }
        else{
            document.getElementById('menu_top').className = "menu";
            $('.menu').css('width', $('body').width());
            offsetmenu = document.getElementsByClassName("menu")[0].offsetTop;
        }
    };

    window.onscroll = function () {
        setPositionMenu();
    };

    var menuBox = menuTop.find(".menu-box");
    var heghtMenuRow = 55;
    var content = $(".content");
    function windowResize(){
        content.removeClass("menu-rows-1");
        content.removeClass("menu-rows-2");
        content.removeClass("menu-rows-3");
        var menuRows = Math.round(menuBox.height() / heghtMenuRow);
        if(menuRows > 0)
            content.addClass("menu-rows-" + menuRows);
    }
    jQuery(window).resize(function () {
        setPositionMenu();
        windowResize();
    });
    /*jQuery(window).scroll(setPositionMenu);
    setPositionMenu();*/
	var deviceType = detect.parse(navigator.userAgent).device.type;
    if(deviceType == "Mobile"){
		$(".menu__item").each(function(){
			if($(this).find(".dropdown-menu").length>0){
                $(this).find("a").first().remove();
                $(this).find("span.menu__link:first-of-type").removeClass("visible-mobi");
			}
		})
	}
    windowResize();
});