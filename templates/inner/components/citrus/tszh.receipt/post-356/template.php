<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**@var bool $printDebugInfo Выводить ифнормацию об источниках данных */
$printDebugInfo = false;

global $APPLICATION, $DB;
if ($_GET["print"] == "Y")
	$APPLICATION->RestartBuffer();

require_once(__DIR__ . '/functions.php');

$APPLICATION->SetPageProperty("SHOW_TOP_LEFT", "N");

if ($_GET["print"] != "Y")
{
	$APPLICATION->AddHeadString('<link href="' . $this->GetFolder() . '/styles.css" rel="stylesheet" type="text/css" />');

	?>
	<p>
		&mdash; <a href="<?=$APPLICATION->GetCurPageParam('print=Y', Array('print'))?>" target="_blank"><?=GetMessage("RCPT_OPEN_RECEIPT_IN_WINDOW")?></a>
		<small><?=GetMessage("TPL_LANDSCAPE_NOTE")?></small>
		<br>
		&mdash; <a href="../index.php"><?=GetMessage("TPL_BACK_TO_PERSONAL")?></a>
	</p>
	<?
}
else
{
	if ($arResult["IS_FIRST"]):
		if ($arResult["MODE"] == "AGENT"):?>
			<style type="text/css">
				<?=$APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"] . $this->GetFolder() . "/styles.css")?>
			</style>
		<? else: ?>
		<!doctype html>
			<html>
				<head>
				<meta http-equiv="content-type" content="text/html;" charset="<?=SITE_CHARSET?>"/>
				<link href="<?=$this->GetFolder()?>/styles.css" rel="stylesheet" type="text/css"/>
		<?endif?>

		<style type="text/css" media="print">
			@page {
				size: 29.7cm 21cm;
				margin: 1cm 1cm;
			}
			.overflowx{
				overflow-x: visible;
			}
			<?if ($arParams["INLINE"] != "Y"):?>
				#receipt table.rcpt-inner tr {
					page-break-inside: avoid;
				}
			<?endif?>
		</style>

		<?if ($arResult["MODE"] == "ADMIN"):?>
			<style type="text/css" media="screen">
				div.rcpt {
					border-bottom: 1pt dashed #666;
					padding-bottom: 1em;
					margin-bottom: 2em;
				}
			</style>
		<?endif;

		if ($arResult["MODE"] == "AGENT"):?>
			<div id="receipt">
		<? else: ?>
				<title><?=GetMessage("RCPT_TITLE")?></title>
			</head>
			<body id="receipt"<?=($printDebugInfo ? '' : ' onload="window.print();"')?>>
		<?endif;
	endif;
}

?>
<div class="rcpt">
    <div class="overflowx">
	<table width="100%">
	<?
	if (!$arResult["HAS_SEPARATE_PENALTIES_RECEIPT"])
	{
		?>
		<tr>
			<td colspan="5" class="rcpt-header">
				<h2><?=GetMessage("TPL_DOCUMENT_TITLE")?></h2>
				<p><strong><?=GetMessage("TPL_DOCUMENT_SUBTITLE")?></strong></p>
			</td>
		</tr>
		<?
	}
 	?>
		<?
		if ($arResult["ACCOUNT_PERIOD"]["IPD"])
		{
			?>
			<tr>
				<td colspan="5" class="rcpt-header">
					<p><strong><?=GetMessage("TPL_DOCUMENT_IPD")?>: <?=$arResult["ACCOUNT_PERIOD"]["IPD"]?></strong></p>
				</td>
			</tr>
			<?
		}
		?>
		<?if ($arResult["IS_OVERHAUL"])
			echo ($arResult["ACCOUNT_PERIOD"]["ELS_OVERHAUL"] ? '<tr><td colspan="1" class="rcpt-header"><p><strong>' . GetMessage("TPL_DOCUMENT_ELS"). ': ' .$arResult["ACCOUNT_PERIOD"]["ELS_OVERHAUL"]. '</strong></p></td></tr>' :
				($arResult["ACCOUNT_PERIOD"]["ELS_MAIN"] ? '<tr><td colspan="1" class="rcpt-header"><p><strong>' . GetMessage("TPL_DOCUMENT_ELS"). ': ' .$arResult["ACCOUNT_PERIOD"]["ELS_MAIN"]. '</strong></p></td></tr>' : "") );
		else
			echo ($arResult["ACCOUNT_PERIOD"]["ELS_MAIN"] ? '<tr><td colspan="1" class="rcpt-header"><p><strong>' . GetMessage("TPL_DOCUMENT_ELS"). ': ' .$arResult["ACCOUNT_PERIOD"]["ELS_MAIN"]. '</strong></p></td></tr>' : "");
		?>
	<tr>
		<td>
			<?=GetMessage("TPL_SECTION1")?>
		</td>
		<td></td>
		<td colspan="3">
			<?=GetMessage("TPL_SECTION2")?>
		</td>
	</tr>
	<tr>
		<td width="44%">
			<?include(__DIR__ . '/1_info.php'); ?>
		</td>
		<td></td>
		<td>
			<?include(__DIR__ . '/2_contractors_info.php') ?>
		</td>
	</tr>
	</table>
    </div>
	<div style="padding: 0 4pt; overflow: hidden;">
        <div class="overflowx">
		<?include(__DIR__ . '/3_charges.php'); ?>
        </div>
		<div style="margin: 1.5em 0; overflow: hidden">
			<div style="width: 42%; float: left;">
				<?=GetMessage("TPL_FOOTER_NOTES");?>
				<?include(__DIR__ . '/5_corrections.php'); ?>
			</div>
			<?include(__DIR__ . '/6_installments.php'); ?>
		</div>
	</div>
	<?

$summ2pay = $arResult["ACCOUNT_PERIOD"]["DEBT_END"];
if (COption::GetOptionString("citrus.tszh", "pay_to_executors_only", "N") == "Y") {
	if (CModule::IncludeModule("vdgb.portaljkh") && method_exists("CCitrusPortalTszh", "setPaymentBase"))
		CCitrusPortalTszh::setPaymentBase($arResult["TSZH"]);
	$summ2pay = CTszhAccountContractor::GetList(array(), array("ACCOUNT_PERIOD_ID" => $arResult["ACCOUNT_PERIOD"]["ID"], "!CONTRACTOR_EXECUTOR" => "N"), array("SUMM"))->Fetch();
	$summ2pay = is_array($summ2pay) ? $summ2pay['SUMM'] - $arResult["ACCOUNT_PERIOD"]["PREPAYMENT"] : 0;
}
if ($summ2pay > 0 && CModule::IncludeModule("citrus.tszhpayment") && ($paymentPath = CTszhPaySystem::getPaymentPath($arResult["TSZH"]["SITE_ID"])))
	echo '<div class="no-print">' . GetMessage("CITRUS_TSZHPAYMENT_LINK", Array("#LINK#" => $paymentPath . '?ptype=' . $arResult['RECEIPT_PAYMENT_TYPE'])) . '</div>';
?>
	<div style="font-style: italic;">
		<?=GetMessage("RCPT_NOTE_TEXT") . ": "?>
		<?=$arResult["IS_OVERHAUL"] ? $arResult["TSZH"]["ANNOTATION_OVERHAUL"] : $arResult["TSZH"]["ANNOTATION_MAIN"]?>
	</div>
</div>

<?
if ($_GET["print"] == 'Y')
{
	if ($arResult["IS_LAST"]):
		if ($arResult["MODE"] == "AGENT")
			echo '</div>';
		else
		{
			echo '</body></html>';
			exit();
		}
			
	endif;

	if (in_array($arResult["MODE"], array("ADMIN", "AGENT")))
		return;
	else
	{
		require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
		die();
	}
}