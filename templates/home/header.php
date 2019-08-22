<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/local/templates/.default/head.php"
	)
);?>
<div class='promo'>
	<!-- ��������� �������� -->
	    <div class="container carousel-wrap">
        <div id="carousel-example-generic" class="carousel slide posit-abs " data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                <li data-target="#carousel-example-generic" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="banner" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Rectangle(1).png" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="banner" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Rectangle(2).png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="banner" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Rectangle(4).png" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="banner" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Rectangle(1).png" alt="Fwo slide">
                </div>
                <div class="carousel-item">
                    <img class="banner" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Rectangle(2).png" alt="Fife slide">
                </div>
            </div>
        </div>
    </div>
    <!-- ��������� header -->
    <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/local/templates/.default/header.php"
	)
);?>

    <div class="container">
        <div class="row mid-banner">
            <div class="col-xl-8 col-md-8 nazv-organ">���� �����������<br> ��� "���������" � ��� "��������"</div>
            <div class="col-xl-4">
			<!-- ��������� ����� c �����, �������� � ������������ -->
			                <div class="container prognoz">
                    <div class="row city">��������� �������</div>
                    <div class="row weather justify-content-end">
                        <div class="col-xl-3 weather_item" id="time">18:54:23</div>
                        <div class="col-xl-6 weather_item" id="date">15 ���� 2019</div>
                        <div class="col-xl-3 weather_item" id="temp">
						<!-- �������� �������� ����������� �� ���������� API. ������ -->
							<div id="1d96936aca5de9b7017747afda3c27c6" class="">
                                <p class="">
                                    <a href="https://world-weather.ru/pogoda/russia/cheboksary/14days/">��������� - ������</a>
                                </p>
                            </div>
                            <script type="text/javascript" charset="utf-8" src="https://world-weather.ru/wwinformer.php?userid=1d96936aca5de9b7017747afda3c27c6"></script>
						<!-- �������� �������� ����������� �� ���������� API. ����� -->
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- ���� � ����� �������� � ��������� ����������� -->
    <div class="container">
        <div class="row">
            <div class="col-xl-6 buttons">
                <a class="button-1" href="/personal/meters/" id="ShowHide1">�������� ��������� ���������</a>
                <a class="button-2" href="/vopros/" id="ShowHide2">������ ���� ������</a>
            </div>			
            <div class="col-xl-6 page-neizv ">
                <div class="block">
				<!-- ��������� ����� � ��������� �������� -->
				<img class="block__img" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Rectangle%204.png" alt=""></div>
                <div class="block color-white">
                    <div class="page-text">��������������� � ���������� ���������� ����������� � �����������</div>
                    <a href="/news.php" class="page-a">������ �������<img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector-right.svg"
                            alt=""></a>
                </div>
            </div>
        </div>
    </div><!-- ����������� ���� � ����� �������� -->	
</div><!-- ����������� ���� ����� �� ���������, ������ � �����/��������/������������ � ��������� �������� -->

	<!-- ��������� ����� � ������� ��������� � �������� -->
	<div class="container bg-gray">
        <div class="row o-company">
            <div class="col-xl-7 ">
                <div class="zagolovok">� ��������� ��� ���������� � ��� ���������</div><br>
                <div class="text-1">���� ������� ���� - �������������� ������������ ���������, ������������ ��
                    ����������,������������� ������ ����������</div>
            </div>
            <div class="col-xl-5">
                <p class="text-2">� �������� ����� �� ����������, ������������, ������������ � ������� ������ � ��������
                    ������ � �. ���������, � ����� �������� ��������� � ������������, �������������� ����� �� ����������
                    ���������� ���������� � �������������� ������������ ����� � ������������ � ��������������
                    �����������, �����������, ����������, ������� � ������������ � �� �������� � ������������ ��������
                    ���������
                    ������ �� �� ������ ���� ������������, ��������� ����������� ������������� ��������� � �����������
                    ������� � ���������� �������� �����.</p>
            </div>
        </div>
    </div>
	
	<!-- ��������� ����� ��������� �������� --> 	
	<div class="container">
        <div class="row news" >
            <div class="col-xl-7">
                <p class="text-nov">�������</p>
                <div class="page-nov">
                    <div class='page-nov__img'><img src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Rectangle%204.2.png" alt=""></div>
                    <div class="page-item">
                        <p>�� ��.������������������ �.54/1 ������� ���� ������� ���������� ��������������</p>
                        <p>��� ���������� �������� ������� ��������� � ������������, ������� ������������ �� ������� ���� �����...
                        </p>
                        <a href="/company/news.php" class="page-a">������ �������<img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector-right.svg"
                                alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
				<p class="text-nov-a"><a href="/company/news.php">��� �������</a> </p>
                <div class="page-nov">
                    <div class="page-item page-item-all">
                        <p>����� ���� ���������-��������.��</p>
                        <p>��� �������� ����������� ������������� ����� � ������ ��������� ��� ���������� ������ ������ ����������� �� �����.</p>
                        <a href="/company/news.php" class="page-a">������ �������<img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector-right.svg"
                                alt=""></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
	
    <!-- ��������� ����� � ������ ������� -->
	<div class="container bg-color-png auth" <?php if ($USER->IsAuthorized()) echo 'style="display:none"' ?>>
        <div class="row auth__content justify-space-beetwen">
            <div class="col-xl-6 auth__left" >
                <p class="text-nov color-white" style="color: #FFFFFF">����� � ������ �������</p>
                <form action="">
                    <div class="container form">
                        <div class="row col-xs-9 col-xl-12">
                            <div class="col-xl-6 col-xs-12 form-group">
                                <label for="login">�����</label>
                                <input type="text" name="login" id="login" placeholder="��� �����">
                            </div>
                            <div class="col-xl-6 col-xs-12 form-group">
                                <label for="password">������</label>
                                <input type="password" name="password" id="password" placeholder="������� ������">
                            </div>
                        </div>
                        <div class="row col-xs-9 col-xl-12">
                            <div class="col-xl-6 form-group-2">
                                <input type="checkbox" name="RadBut" id="" checked>
                                <label for="RadBut">��������� ����</label>
                            </div>
                            <div class="col-xl-6 form-group-2 text-align-right">
                                <a class="return_pasword" href="">����� ������</a>
                            </div>
                        </div>
                        <div class="row col-xs-9 col-xl-12 auth__panel">
                            <div class="col-xl-5">
                                <button type="submit">�����</button>
                            </div>
                            <div class="col-xl-7 ">
                                <p class="messadge">� ��� ��� ������ � ������? �� ������ <a
                                        href="regisration">������������������</a> ����� ������.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-6 kabinet_right">
                <p class="kabinet-text">��������� ������������, ��� ����� �� ��� ����� ���� ���������-��������.�� �����
                    � ������ � ����� etker21.ru �� ��������. ��� �������� ����������� ������������� ����� � ������
                    ��������� ���
                    ���������� ������ ������ ����������� �� �����. </p>
                <p class="kabinet-zag">����� ����� � ������ ������� �� ����� �� �������:</p>
                <ul>
                    <li class="spisok-items">���������� ������ �������� �����</li>
                    <li class="spisok-items">�������� ���������</li>
                    <li class="spisok-items"> ����������� ���������</li>
                    <li class="spisok-items"> ������ ������ ����������� ���
                    </li>
                </ul>
            </div>
        </div>
    </div>
	
    <!-- ��������t ����� ����� -->
	<div class="container container--map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d793.2418275931435!2d47.31861633095179!3d56.10773398440998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x415a3653c7aaf4f3%3A0x3c0b823106a4d03d!2z0K3RgtC60LXRgA!5e0!3m2!1sru!2sru!4v1564075618693!5m2!1sru!2sru"
            width="100%" height="524px" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>