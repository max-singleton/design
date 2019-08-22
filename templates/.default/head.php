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
