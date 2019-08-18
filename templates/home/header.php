<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
require_once($_SERVER["DOCUMENT_ROOT"] . DEFAULT_TEMPLATE_PATH . "/functions.php");

use Bitrix\Main\Page\Asset;

define('PATH_PERSONAL', 'personal');
$curPage = $APPLICATION->GetCurPage(false);
define('ISPERSONAL', strpos($curPage, SITE_DIR . PATH_PERSONAL) !== false);
/*if (strpos($curPage, SITE_DIR . "personal") !== false)
{
	$curPage = str_replace(SITE_DIR . "personal", SITE_DIR . PATH_PERSONAL, $curPage);
	LocalRedirect($curPage);
}*/
global $USER;
$APPLICATION->SetPageProperty("top_menu", "top_adaptive");
$APPLICATION->SetPageProperty("PATH_PERSONAL", PATH_PERSONAL);

define('IS_SITE_DIR', $curPage == SITE_DIR);
define('SHOW_NAV_CHAIN_DEFAULT', !IS_SITE_DIR && $APPLICATION->GetProperty('show_nav_chain_default', 'Y') == 'Y');
?><!DOCTYPE html>
<html lang="en">

<head>
	<?php $APPLICATION->ShowHead();?>
	<!-- Необходимые Мета-теги всегда на первом месте -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link
		href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
		rel="stylesheet">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css"
		  integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= DEFAULT_TEMPLATE_PATH ?>/css/style.css">
	<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php
		CJsCore::Init(Array('jquery'));
		Asset::getInstance()->addString('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">');
		Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . "/js/script.js");
		Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . "/js/detect.min.js");
//$APPLICATION->SetAdditionalCSS('/bitrix/templates/citrus_tszh_adaptive_darkblue/colors.css');
		$APPLICATION->ShowHead(false);
		?>
		<title><? $APPLICATION->AddBufferContent('TemplateShowTitle'); ?></title>
</head>

<body class="page">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

	<div class="top-line" style="height:0px">
			<div class="top-line__box">
<!--noindex--><?
				$APPLICATION->IncludeComponent(
								"bitrix:system.auth.form", 
								"header-auth", 
								array(
									"REGISTER_URL" => SITE_DIR."auth/?register=yes",
									"FORGOT_PASSWORD_URL" => SITE_DIR."auth/?forgot_password=yes",
									"PROFILE_URL" => SITE_DIR.PATH_PERSONAL."/info/",
									"SHOW_ERRORS" => "Y",
									"COMPONENT_TEMPLATE" => "header-auth"
								),
								false
							);
				?><!--/noindex-->
			</div>
		</div>

<div class='promo'>
	<!-- Включение слайдера -->
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
    <!-- Включение header -->
    <div class="container ">
    <div class="row header">
        <div class="col-xl-3 col-lg-3 col-md-3 ">
            <div class="container logo">
                <a href="/"><img class="logos" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Logo.png" alt=""></a>
            </div>
        </div>
        <div class="col-xl-9 col-md-9">
            <!-- Включение блока с контактной информацией -->
                            <div class="container">
                    <div class="row contact-group">
                        <div class="col-xl-3 col-lg-3 contact-item">

                        </div>
                        <div class="offset-xl-2 col-xl-4 offset-lg-2 col-lg-4 contact-item ">
                            <div class="contact">Приемная</div>
                            <div class="contact">+7 (8352) 25-92-33</div>
                            <div class="contact">понедельник - пятница с 8.00 до 17.00</div>
                        </div>
                        <div class="col-xl-3  col-lg-3 contact-item">
                            <div class="contact">Диспетчерская</div>
                            <div class="contact">+7 (8352) 53-22-66</div>
                            <div class="contact">Круглосуточно</div>
                        </div>
<!--                        <div class="col-xl-3 col-lg-3 contact-item">
                            <div class="contact">Почта</div>
                            <div class="contact">mail@достояние-наследие.рф</div>
                            <div class="contact">Для ваших обращений</div>
                        </div>-->
                    </div>
                </div>
            <!-- Вход в личный кабинет и регистрация -->
            <div class="container">
                <div class="row menu">
                    <div class="col-xl-8 col-md-12 navig nav">
                    </div>
					<div class="col-xl-4 col-md-12 navig-2">
                        <li class="navigation-items">
                            <img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector.png" alt="">
							<?php if (!($USER->IsAuthorized())) echo '<a class="window-open" href="javascript:void(0)" window="window-auth" init="true">ВХОД В ЛИЧНЫЙ КАБИНЕТ</a>' ?>
							<?php if ($USER->IsAuthorized()) echo '<a href="/personal/info">ВХОД В ЛИЧНЫЙ КАБИНЕТ</a>' ?>
							<li class="navigation-items" <?php if ($USER->IsAuthorized()) echo 'style="display:none"'?>>
                            <img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector-pencil.svg" alt="">
                        <a class="window-open" href="javascript:void(0)" window="window-register" init="true">РЕГИСТРАЦИЯ</a>
						</li>
                    </div>
                </div>
            </div>
        </div>
        <div class="burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div><!-- Закрытие блока с логотипом и со входом в личный кабинет и регистрацию -->
    <div class="row">
        <div class="col-md-12">
            <!-- Включение верхнего меню -->

<style>

    /*| Navigation |*/

    nav{
        /*background: #334;*/ /* Задаем основной фон меню */
        padding: 0 3%; /* Задаем внутренние отступы */
        z-index: 100;
    }

    nav ul {
        list-style: none; /* Убираем маркер для элементов списка */
    }

    nav ul li {
        display:inline-block;/*Выстраиваем пункты меню в ряд по горизонтали */
    }

    nav ul li a {
        display:block; /* Настраиваем оформление пунктов меню */
        padding: 15px 20px;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        line-height: 19px;
        color: #FFFFFF;
        letter-spacing: 1px;
        text-decoration: none;
        /*text-transform: uppercase;*/
        /*border-top: 1px solid #445;*/
    }
    nav > ul > li > ul > li > a{
        /*Выпадающее меню*/
        align: center;
        font-weight: normal;
        clear: both;
        border-radius: 50px;
    }
    nav ul li a:hover{
        /*Цвет ссылки при наведении*/
        color:#FFFFFF;
        border-radius: 50px;
    }
    navigation:hover {
        box-shadow: 0 0 0 99999px rgba(0, 0, 0, 0.8);
    }
    nav ul li:hover {
        background: #4A76A8; /* Меняем фон пункта меню при наведении указателя мыши */
        border-radius: 50px;
    }

    nav ul li ul {
        display: none; /* Прячем пункты выпадающего блока меню */
        position:absolute;
        z-index: 6;
        /*background: #ccc;*/ /* Задаем фон выпадающего блока меню */
        float: none;
        padding-inline-start: 20px;
    }

    nav ul li:hover ul {
        display:block; /* Отображаем подменю при наведении мыши */
        Z-index:4;
    }

    nav ul li ul li {
        display:block; /* Выстраиваем по вертикали пункты выпадающего меню */
    }

    nav ul li a:hover {
        /*При наведении на подменю все затемняется*/
        box-shadow: 0 0 0 99999px rgba(0, 0, 0, 0.8);
    }
</style>

<div class="container zatemnenie">
        <div class="row menu">
            <div class="col-xl-12 col-md-12 navig nav">
                <nav role="navigation">
                    <ul id="ul">
                        <li><a href="/">ГЛАВНАЯ</a></li>
                        <li><a href="/about/">О КОМПАНИИ</a>
                            <ul class="submenu">
                                <li><a href="/news/">Новости</a></li>
                                <li><a href="/company/services.php">Услуги</a></li>
                                <li><a href="/company/jobs.php">Вакансии</a></li>
                                <li><a href="/company/paid_services.php">Платные работы</a></li>
                                <li><a href="/company/docs.php">Документы</a></li>
                            </ul>
                        </li>
                        <li><a href="/contacts/">КОНТАКТНАЯ ИНФОРМАЦИЯ</a>
                            <ul class="submenu" style="padding-inline-start: 60px;">
                                <li><a href="/contacts/">График работы</a></li>
                                <li><a href="/contacts/requisites.php">Реквизиты</a></li>
                            </ul>
                        </li>
                        <li><a href="/doma-v-obsluzhivanii/">ДОМА В ОБСЛУЖИВАНИИ</a>
                            <ul class="submenu" style="padding-inline-start: 40px;">
                                <li><a href="/doma-v-obsluzhivanii/ooo-dostoyanie.php">ООО "Достояние"</a></li>
                                <li><a href="/doma-v-obsluzhivanii/ooo-nasledie.php">ООО "Наследие"</a></li>
                            </ul>
                        </li>
                        <li><a href="/vopros/">ЗАДАТЬ ВОПРОС?</a></li>
                    </ul>
                </nav>
            </div>
        </div>
</div>

<!-- Скрипт для красивого выпадания меню -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(".five li ul").hide();
        $(".five li:has('.submenu')").hover(
            function(){
                $(".five li ul").stop().fadeToggle(300);}
        );
    </script>
        </div>
    </div>
</div>    

    <div class="container">
        <div class="row mid-banner">
            <div class="col-xl-8 col-md-8 nazv-organ">Сайт организаций<br> ООО "Достояние" и ООО "Наследие"</div>
            <div class="col-xl-4">
			<!-- Включение блока c датой, временем и температурой -->
			                <div class="container prognoz">
                    <div class="row city">Чебоксары сегодня</div>
                    <div class="row weather justify-content-end">
                        <div class="col-xl-3 weather_item" id="time">18:54:23</div>
                        <div class="col-xl-6 weather_item" id="date">15 июля 2019</div>
                        <div class="col-xl-3 weather_item" id="temp">
						<!-- Получаем значение температуры от стороннего API. Начало -->
							<div id="1d96936aca5de9b7017747afda3c27c6" class="">
                                <p class="">
                                    <a href="https://world-weather.ru/pogoda/russia/cheboksary/14days/">Чебоксары - погода</a>
                                </p>
                            </div>
                            <script type="text/javascript" charset="utf-8" src="https://world-weather.ru/wwinformer.php?userid=1d96936aca5de9b7017747afda3c27c6"></script>
						<!-- Получаем значение температуры от стороннего API. Конец -->
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Блок с двумя кнопками и последним объявлением -->
    <div class="container">
        <div class="row">
            <div class="col-xl-6 buttons">
                <a class="button-1" href="/personal/meters/" id="ShowHide1">Передать показания счетчиков</a>
                <a class="button-2" href="/vopros/" id="ShowHide2">Задать свой вопрос</a>
            </div>			
            <div class="col-xl-6 page-neizv ">
                <div class="block">
				<!-- Включение блока с последним объявленим -->
				<img class="block__img" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Rectangle%204.png" alt=""></div>
                <div class="block color-white">
                    <div class="page-text">Благоустройство и озеленение территорий организаций и предприятий</div>
                    <a href="/news.php" class="page-a">Читать новость<img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector-right.svg"
                            alt=""></a>
                </div>
            </div>
        </div>
    </div><!-- Закрывается блок с двумя кнопками -->	
</div><!-- Закрывается блок промо со слайдером, блоком с датой/временем/температурой и последним объявлением -->

	<!-- Включения блока с кратким описанием о компании -->
	<div class="container bg-gray">
        <div class="row o-company">
            <div class="col-xl-7 ">
                <div class="zagolovok">О компаниях ООО «Достояние» и ООО «Наследие»</div><br>
                <div class="text-1">Наша главная цель - удовлетворение потребностей населения, проживающего на
                    территории,обслуживаемой нашими компаниями</div>
            </div>
            <div class="col-xl-5">
                <p class="text-2">В оказании услуг по содержанию, обслуживанию, эксплуатации и ремонту жилого и нежилого
                    фондов в г. Чебоксары, а также домового хозяйства и оборудования, предоставлении услуг по содержанию
                    придомовых территорий и предоставлению коммунальных услуг в соответствии с установленными
                    стандартами, параметрами, критериями, нормами и требованиями к их качеству и безопасности согласно
                    положений
                    Закона РФ «О защите прав потребителей», условиями заключенных хозяйственных договоров и отраслевыми
                    нормами и тарифамина оказание услуг.</p>
            </div>
        </div>
    </div>
	
	<!-- Включение блока последних новостей --> 	
	<div class="container">
        <div class="row news" >
            <div class="col-xl-7">
                <p class="text-nov">НОВОСТИ</p>
                <div class="page-nov">
                    <div class='page-nov__img'><img src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Rectangle%204.2.png" alt=""></div>
                    <div class="page-item">
                        <p>По пр.Тракторостроителей д.54/1 выходит срок поверки квартирных теплосчетчиков</p>
                        <p>Вам необходимо провести поверку счетчиков в организациях, имеющих аккредитацию по данному виду работ...
                        </p>
                        <a href="/news.php" class="page-a">Читать новость<img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector-right.svg"
                                alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <p class="text-nov-a"><a href="/news/">ВСЕ НОВОСТИ</a> </p>
                <div class="page-nov">
                    <div class="page-item page-item-all">
                        <p>Новый сайт достояние-наследие.рф</p>
                        <p>Для удобного пользования возможностями сайта и личным кабинетом вам необходимо заново пройти регистрацию на сайте.</p>
                        <a href="/news/" class="page-a">Читать новость<img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector-right.svg"
                                alt=""></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
	
    <!-- Включение входа в личный кабинет -->
	<div class="container bg-color-png auth" <?php if ($USER->IsAuthorized()) echo 'style="display:none"' ?>>
        <div class="row auth__content justify-space-beetwen">
            <div class="col-xl-6 auth__left" >
                <p class="text-nov color-white" style="color: #FFFFFF">ВОЙТИ В ЛИЧНЫЙ КАБИНЕТ</p>
                <form action="">
                    <div class="container form">
                        <div class="row col-xs-9 col-xl-12">
                            <div class="col-xl-6 col-xs-12 form-group">
                                <label for="login">Логин</label>
                                <input type="text" name="login" id="login" placeholder="Ваш логин">
                            </div>
                            <div class="col-xl-6 col-xs-12 form-group">
                                <label for="password">Пароль</label>
                                <input type="password" name="password" id="password" placeholder="Введите пароль">
                            </div>
                        </div>
                        <div class="row col-xs-9 col-xl-12">
                            <div class="col-xl-6 form-group-2">
                                <input type="checkbox" name="RadBut" id="" checked>
                                <label for="RadBut">Запомнить меня</label>
                            </div>
                            <div class="col-xl-6 form-group-2 text-align-right">
                                <a class="return_pasword" href="">Забыл пароль</a>
                            </div>
                        </div>
                        <div class="row col-xs-9 col-xl-12 auth__panel">
                            <div class="col-xl-5">
                                <button type="submit">Войти</button>
                            </div>
                            <div class="col-xl-7 ">
                                <p class="messadge">У вас нет логина и пароля? Вы можете <a
                                        href="regisration">зарегистрироваться</a> прямо сейчас.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-6 kabinet_right">
                <p class="kabinet-text">Уважаемые пользователи, для входа на наш новый сайт достояние-наследие.рф логин
                    и пароль с сайта etker21.ru не подходит. Для удобного пользования возможностями сайта и личным
                    кабинетом вам
                    необходимо заново пройти регистрацию на сайте. </p>
                <p class="kabinet-zag">После входа в личный кабинет на сайте вы сможете:</p>
                <ul>
                    <li class="spisok-items">Посмотреть баланс лицевого счета</li>
                    <li class="spisok-items">Передать показания</li>
                    <li class="spisok-items"> Распечатать квитанцию</li>
                    <li class="spisok-items"> Задать вопрос руководству ЖКХ
                    </li>
                </ul>
            </div>
        </div>
    </div>
	
    <!-- Включениt карты сайта -->
	<div class="container container--map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d793.2418275931435!2d47.31861633095179!3d56.10773398440998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x415a3653c7aaf4f3%3A0x3c0b823106a4d03d!2z0K3RgtC60LXRgA!5e0!3m2!1sru!2sru!4v1564075618693!5m2!1sru!2sru"
            width="100%" height="524px" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>