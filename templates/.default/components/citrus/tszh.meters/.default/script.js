//���� ������ ������ ������� ������� "������� ���������" ������ � 23 �� 26 ����� ������� ������
$(document).ready(function() {
    var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
    if(dd >= 23 && dd <= 26) {
          $(".mydiv").show();
     }
});