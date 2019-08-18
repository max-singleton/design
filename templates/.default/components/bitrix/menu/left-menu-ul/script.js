//копирование элементов пунктов левого меню с десктопной версии в мобильную
$(document).ready(function() {
    var obj = [['.leftmenu__menu-active','.mobi-leftmenu__header'],['.div-flex .leftmenu','.mobi-leftmenu .leftmenu']];
    obj.forEach(function (t) {
        var elementFrom = $(t[0]);
        if(elementFrom.length == 1){
            var elementTo = $(t[1]);
            if(elementTo.length == 1){
                elementTo.html(elementFrom.html());
            }
        }
    });
    obj = $('.mobi-leftmenu .leftmenu__menu-active');
    if(obj.length == 1)
        obj.removeClass('leftmenu__menu-active');
    //перенос заголовка на уровень выше
    var title = $(".div-flex .left-area-title");
    if(title.length == 1){
        $(".content__padding").prepend(title.remove());
    }
});