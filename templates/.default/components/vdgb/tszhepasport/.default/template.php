<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
} ?>

<? if ($_GET['home-id']): ?>
	<script type="text/javascript">
        var home_id = <?echo $enc_value = \Bitrix\Main\Web\Json::encode($arResult["ID_HOME"], $options = null);?>;
	</script>
	<?
	$pos = strripos($_SERVER['REQUEST_URI'], '?');
	$rest = substr($_SERVER['REQUEST_URI'], 0, $pos);
	?>
	<script type="text/javascript" src="/bitrix/components/vdgb/tszhepasport.detail/templates/.default/list-not-scroll.js"></script>
	<!--<a href=--><? //=$rest?><!-- >Назад к списку домов</a><br /><br />-->
	<!--	<div class="h3_home"><h3>--><? //=$arResult['EP_ADDRESS']?><!--</h3></div>-->


	<h2><?=$arResult['HTML_NAME_1']?></h2>
	<?=$arResult['HTML_THIS_1']?>

	<h2><?=$arResult['HTML_NAME_2']?></h2>
	<?=$arResult['HTML_THIS_2']?>

	<h2><?=$arResult['HTML_NAME_3']?></h2>
	<?=$arResult['HTML_THIS_3']?>


	<? if ($arResult['EP_TYPE'] == 'A'): ?>
		<h2><?=$arResult['HTML_NAME_4']?></h2>
		<?=$arResult['HTML_THIS_4']?>

		<h2><?=$arResult['HTML_NAME_5']?></h2>
		<?=$arResult['HTML_THIS_5']?>
	<? endif ?>


<? endif ?>

