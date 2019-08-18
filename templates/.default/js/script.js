document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('.burger');
    const buttonClose = document.querySelector('.mobile-menu__burger');
    const page = document.querySelector('.page');
    const mobileMenu = document.querySelector('.mobile-menu');
    if (!button) return;
    
    const BURGER_ACTIVE = 'burger--active';
    const PAGE_FROZY = 'page--frozy';
    
    button.addEventListener('click', function(e) {
        e.preventDefault();
        page.classList.add(PAGE_FROZY);
        button.classList.add(BURGER_ACTIVE);
        mobileMenu.classList.add('mobile-menu--active');
    })
    
    buttonClose.addEventListener('click', function(e) {
        e.preventDefault();
        page.classList.remove(PAGE_FROZY);
        button.classList.remove(BURGER_ACTIVE);
        mobileMenu.classList.remove('mobile-menu--active');
    })
    document.addEventListener('click', function(e) {
        const target = e.target;
        if (target == mobileMenu) {
            page.classList.remove(PAGE_FROZY);
            button.classList.remove(BURGER_ACTIVE);
            mobileMenu.classList.remove('mobile-menu--active');
        }
    })
})

$(document).ready(function() {
    /*** переход по родительской ссылке при нажатии на переключатель start ***/
    var switchButtons = $(".radio-switcher a input, .radio-switcher a label");
    switchButtons.each(function(){
        $(this).click(function(){
            var parEl = $(this).parent();
            var onclickVal = parEl.attr('onclick');
            if(onclickVal == null || onclickVal.indexOf('BX.ajax') == -1){
                var href = parEl.attr('href');
                if(href && href != "")
                    document.location.href = href;
            }
        });
    });
    /*** переход по родительской ссылке при нажатии на переключатель end ***/
    BX.ready(function() {
        function initWindow(){
            var shadow = $(".shadow");
            var openLinks = $(".window-open"), close = $(".window__close,.window-close"), windowEls = $(".window");
            openLinks.each(function(){
                if($(this).attr("init")==true)
                    return;
                $(this).attr("init",true);
                $(this).click(function(){
                    shadow.hide();
                    windowEls.hide();
                    var windowEl = $('#' + $(this).attr('window'));
                    if(windowEl.is(':hidden')){
                        windowEl.show();
                        shadow.show();
                        $(document).scrollTop(windowEl.offset().top - 10);
                    }
                    else{
                        windowEl.hide();
                        shadow.hide();
                    }
                })
            });
            close.each(function(){
                if($(this).attr("init")==true)
                    return;
                $(this).click(function(){
                    $(this).closest(".window").hide();
                    shadow.hide();
                });
            });
            if(!shadow.attr("init")){
                shadow.attr("init",true);
                shadow.click(function() {
                    shadow.hide();
                    windowEls.hide();
                });
            }
        }

        BX.addCustomEvent('onAjaxSuccess', function () {
            initWindow();
        });
        initWindow();
    });
});




