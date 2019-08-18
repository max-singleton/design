'use strict';

$(function () {
    var note = $('#tszhAuthNote'),
        phone = $('#tszhAuthNote .tszh-note-phone');
    var getCurrentOrg = function () {
        var id = $('input[name=TSZH_ID]').val();
        if (!id)
            id = $('select[name=TSZH_ID]').val();
        return id;
    };
    var showHideNote = function () {
        var org = getCurrentOrg();
        if (org != null && window.tszhHasAccounts[org] !== undefined) {
            note.show();
            phone.html(window.tszhHasAccounts[org]);
        } else {
            note.hide();
        }
    };
    $('select[name=TSZH_ID]').change(function () {
        showHideNote();
    })

    showHideNote();
});


BX.ready(function () {
    var x, i, j, selElmnt, a, b, c;

    x = BX("tszh-payment-select");
    selElmnt = BX.findChild(x, {
        'tag': 'select',
    });

    a = BX.create(
        'div',
        {
            attrs: {
                className: 'select-selected'
            },
            text: selElmnt.options[selElmnt.selectedIndex].innerHTML
        }
    );

    BX.append(a, x);

    b = BX.create(
        'div',
        {
            attrs: {
                className: 'select-items select-hide'
            }
        }
    );

    for (j = 0; j < selElmnt.length; j++) {
        var attr = {
            text: selElmnt.options[j].innerHTML
        };
        if (selElmnt.selectedIndex === j) {
            attr.attrs = {
                className: 'same-as-selected'
            };
        }
        c = BX.create(
            'div',
            attr
        );
        BX.bind(c, 'click', function () {
            var y, i, k;
            for (i = 0; i < selElmnt.length; i++) {
                if (selElmnt.options[i].innerHTML == this.innerHTML) {
                    selElmnt.selectedIndex = i;
                    a.innerHTML = this.innerHTML;
                    y = BX.findChild(b, {
                            "tag": "div",
                            "class": "same-as-selected"
                        },
                        true,
                        true);
                    for (k = 0; k < y.length; k++) {
                        BX.removeClass(y[k], 'same-as-selected');
                    }
                    BX.addClass(this, 'same-as-selected');
                    break;
                }
            }
        });
        BX.append(c, b);
    }
    BX.append(b, x);

    BX.bind(a, 'click', function (e) {
        e.stopPropagation();
        closeAllSelect(this);
        BX.toggleClass(b, 'select-hide');
        BX.toggleClass(this, 'select-arrow-active');
    });

    function closeAllSelect(elmnt) {
        var x, y, i, arrNo = [];
        x = BX.findChild(
            document,
            {
                'class': 'select-items'
            },
            true,
            true
        );
        y = BX.findChild(
            document,
            {
                'class': 'select-selected'
            },
            true,
            true
        );
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                BX.removeClass(y[i], 'select-arrow-active');
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                BX.addClass(x[i], 'select-hide');
            }
        }
    }

    BX.bind(document, 'click', function () {
        closeAllSelect();
    });
});