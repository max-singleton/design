

var arMaps = [];
$(document).ready(function () {
    function activateTszhContactsTab(tabEl){
        if(tabEl.length == 0)
            return;
        var tszhID = tabEl.val();
        BX('feedback-tszh_id').value = tszhID;
        var arMap = arMaps[tszhID];
        if (arMap && !arMap.zoomed && arMap.map && arMap.map.getZoom() <= 0)
        {
            var center = arMap.map.getCenter();
            arMap.map.setCenter([0, 0], 15);
            arMap.map.panTo(center);
            arMap.zoomed = true;
            var map = $(this).find(".map-container>div>div");
            var contactsGroup = tabEl.closest(".t-contacts").find('section[sectionid="'+ tszhID + '"]');
            var requisite = contactsGroup.find(".t-contacts-group__cell").first();
            var padding = 15, maxWidthReq = requisite.outerWidth() + 10, maxWidthMap = 370;
            requisite.css("max-width",maxWidthReq);
            contactsGroup.css('padding', padding);
            function resize(){
                if(map.length == 0)
                    map = contactsGroup.find(".map-container>div>div");
                if(map.length == 1){
                    var w = contactsGroup.innerWidth();
                    if(w > 0){
                        var mapWidth = w - requisite.outerWidth() - padding*2;
                        if(mapWidth > maxWidthMap){
                            requisite.css("max-width",maxWidthReq + mapWidth - maxWidthMap);
                            mapWidth = maxWidthMap;
                        }
                        map.css("width",mapWidth);
                    }
                }
            }
            jQuery(window).resize(function () {
                resize();
            })
            resize();
        }
    }

    $(".t-contacts>input").change(function () {
        activateTszhContactsTab($(this));
    });
    activateTszhContactsTab($(".t-contacts>input:checked"));
    $(".t-contacts section").each(function () {
        var id = $(this).attr("sectionId");
        var form = $(this).find("form[id='feedbackForm']");
        form.attr("id","feedbackForm-"+id);
        form.attr("action", form.attr("action")+"-"+id);
        form.attr("style", "top: -55px; position: relative; padding-top: 55px;");
        form.find("input[name='tszh_id']").val(id);
        var confirm = form.find(".input-checkbox input[name='confirm']");
        if(confirm.length == 1){
            confirm.attr("id","confirm-"+id);
            confirm.parent().find("label").attr("for","confirm-"+id);
        }

    });
})

$(document).ready(function(){
    var h2 = $(".subpage .page-title+h2");
    if(h2.length == 1){
        $(".subpage .page-title").text(h2.text());
        h2.remove();
    }
})
