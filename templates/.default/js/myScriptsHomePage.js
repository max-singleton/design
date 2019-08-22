<!--��������� �������� �������. ������ -->
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    t = setTimeout(function() {
        startTime()
    }, 500);
}
startTime();
<!--��������� �������� �������. ����� -->

<!--��������� ������� ����. ������ -->
Data = new Date();
Year = Data.getFullYear();
Month = Data.getMonth();
Day = Data.getDate();

// ����������� ������
switch (Month)
{
    case 0: fMonth="������"; break;
    case 1: fMonth="�������"; break;
    case 2: fMonth="�����"; break;
    case 3: fMonth="������"; break;
    case 4: fMonth="���"; break;
    case 5: fMonth="����"; break;
    case 6: fMonth="����"; break;
    case 7: fMonth="�������"; break;
    case 8: fMonth="��������"; break;
    case 9: fMonth="�������"; break;
    case 10: fMonth="������"; break;
    case 11: fMonth="�������"; break;
}

// �����
document.getElementById('date').innerHTML = (Day+" "+fMonth+" "+Year);
<!--��������� ������� ����. ����� -->


<!--����������� ���������� �������� �����������, ���������� �� ���������� API. ������ -->
$(document).ready(function(){
    $("#\\31 d96936aca5de9b7017747afda3c27c6 > a").css({"color": "#fff", "line-height":"26px"});
    $("#\\31 d96936aca5de9b7017747afda3c27c6 > a").css('line-height', '26px');
    $("#\\31 d96936aca5de9b7017747afda3c27c6 > a > div.weatherInformer22-temp").css({"font-size":"24px", "top":"0px"});
});
<!--����������� ���������� �������� �����������, ���������� �� ���������� API. ����� -->

/*��� ��������� �� ���� �� ������ ������ ������ ������ ���� �� ������ ������*/
$(document).ready( function () {
    $(function () {
        $("#ShowHide1").css({"background":"#4A76A8"});
        $("#ShowHide2").mouseover(function(){
            $("div.col-xl-6.buttons > a.button-2").css("background","#4A76A8");
            $("#ShowHide1").css("background","");
    });
        $("#ShowHide2").mouseout(function(){
            $("div.col-xl-6.buttons > a.button-2").css("background","");
            $("#ShowHide1").css("background","#4A76A8");
        });
    });
});

/*��� ��������� �� ���� �� ������ ������ ������ ������ ���� � ������*/
$(document).ready( function () {
    $(function () {
        $("#ShowHide3").css({"background":"#4A76A8"});
        $("#ShowHide4").mouseover(function(){
            $("div.col-xl-12.col-md-5.push-md-1.push-xl-0.btn-but-2").css("background","#4A76A8");
            $("body > div.container.bg-footer > div > div.top-footer.row > div.col-xl-3.col-md-11.offset-md-1.col-xs-12.offset-xl-0.btn-but > div.col-xl-12.col-md-5.btn-but-1").css("background","#262626");
            $("#ShowHide3").css("background","#262626");
            $("body > div.container.bg-footer > div > div.top-footer.row > div.col-xl-3.col-md-11.offset-md-1.col-xs-12.offset-xl-0.btn-but > div.col-xl-12.col-md-5.btn-but-1").css("border","1px solid #FFFFFF");
    });
        $("#ShowHide4").mouseout(function(){
            $("div.col-xl-12.col-md-5.push-md-1.push-xl-0.btn-but-2").css("background","#262626");
            $("body > div.container.bg-footer > div > div.top-footer.row > div.col-xl-3.col-md-11.offset-md-1.col-xs-12.offset-xl-0.btn-but > div.col-xl-12.col-md-5.btn-but-1").css("background","#4A76A8");
            $("#ShowHide3").css("background","#4A76A8");
            $("body > div.container.bg-footer > div > div.top-footer.row > div.col-xl-3.col-md-11.offset-md-1.col-xs-12.offset-xl-0.btn-but > div.col-xl-12.col-md-5.btn-but-1").css("border","1px solid #FFFFFF");
        });
    });
});
