<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>
<table class="rcpt-inner">
	<colgroup>
		<col width="50%">
		<col width="50%">
	</colgroup>
	<tr>
		<td colspan="2">
			<?= GetMessage("TPL_DOCUMENT_DATE", Array("#DATE#" => $arResult['ACCOUNT_PERIOD']['DISPLAY_NAME'])) ?>

			<span style="margin-left: 3em;"><?= GetMessage("TPL_PERIOD") ?></span>

			<p><?= GetMessage("TPL_ACCOUNT_OWNER") ?></p>

			<p><strong class="rcpt-big"><?= $arResult['ACCOUNT_PERIOD']['ACCOUNT_NAME'] ?></strong></p>

			<div><?= GetMessage("TPL_ADDRESS") ?>:
				<strong><?= CTszhAccount::GetFullAddress($arResult['ACCOUNT_PERIOD']) ?></strong></div>
		</td>
	</tr>
	<tr class="rcpt-hr">
		<td style="white-space: nowrap; padding-bottom: 5px;">
			<?= GetMessage("TPL_AREA", Array(
					"#AREA#" => $arResult['ACCOUNT_PERIOD']['AREA'] ? CCitrusTszhReceiptComponentHelper::num($arResult['ACCOUNT_PERIOD']['AREA'], true, -1) : '&ndash;',
					"#HOUSE_AREA#" => $arResult['ACCOUNT_PERIOD']['HOUSE_AREA'] ? CCitrusTszhReceiptComponentHelper::num($arResult['ACCOUNT_PERIOD']['HOUSE_AREA'], true, -1) : '&ndash;'
				)) ?>
		</td>
		<td style="white-space: nowrap; padding-bottom: 5px;">
			<?= GetMessage("TPL_PEOPLE", Array(
					"#PEOPLE#" => $arResult['ACCOUNT_PERIOD']['PEOPLE'] ? $arResult['ACCOUNT_PERIOD']['PEOPLE'] : '&ndash;',
					"#REGISTERED_PEOPLE#" => $arResult['ACCOUNT_PERIOD']['REGISTERED_PEOPLE'] ? $arResult['ACCOUNT_PERIOD']['REGISTERED_PEOPLE'] : '&ndash;'
				)) ?>
		</td>
	</tr>
	<tr class="rcpt-hr">
		<td colspan="2">
			<p style="margin-top: 0;">
				<?= GetMessage("TPL_ORG_NAME") ?>: <strong
					style="margin-left: 1.5em;"><?= $arResult["TSZH"]["NAME"] ?></strong>
				<span style="float: right;"><?= GetMessage("TPL_ORG_INN") ?>
					:&nbsp;<strong><?= $arResult["TSZH"]["INN"] ?></strong></span>
			</p>
			<?
			if (strlen(trim($arResult["TSZH"]["ADDRESS"])))
			{
				?><p><?= GetMessage("TPL_ADDRESS") ?>: <strong
				style="margin-left: 1.5em;"><?= $arResult["TSZH"]["ADDRESS"] ?></strong></p><?
			}
			$url = CTszh::getSiteUrl($arResult["TSZH"]["SITE_ID"]);
			$host = parse_url($url, PHP_URL_HOST);
			$host = \CBXPunycode::ToUnicode(trim($host), $errors);
			$email = trim($arResult["TSZH"]["EMAIL"]);
			?>
			<p>
				<?
				if (strlen(trim($arResult["TSZH"]["PHONE"])))
				{
					?><?= GetMessage("TPL_PHONE_FAX") ?>: <strong
					style="margin-left: 1.5em;"><?= $arResult["TSZH"]["PHONE"] ?></strong>, <?
				}
				?>
				<a href="<?= $url ?>"
				   target="_blank"><?= $host ?></a><?= (strlen($email) ? ', <a href="mailto:' . $email . '">' . $email . '</a>' : '') ?>
			</p>
			<?

			if (strlen(trim($arResult["TSZH"]["PHONE_DISP"])))
			{
				?><p><?= GetMessage("TPL_DISP") ?>: <strong
				style="margin-left: 1.1em;"><?= $arResult["TSZH"]["PHONE_DISP"] ?></strong></p><?
			}
			if (isset($arResult["TSZH"]["UF_RECEIPT_NOTE"]) && strlen(trim($arResult["TSZH"]["UF_RECEIPT_NOTE"])))
			{
				?><p style="line-height: 120%;"><?= nl2br($arResult["TSZH"]["UF_RECEIPT_NOTE"]) ?></p><?
			}
			?>
			<?= $arResult["IS_OVERHAUL"] ? $arResult["TSZH"]["ADDITIONAL_INFO_OVERHAUL"] : $arResult["TSZH"]["ADDITIONAL_INFO_MAIN"] ?>
		</td>
	</tr>
	<?
	if (is_set($arResult, "EXECUTOR") && is_array($arResult["EXECUTOR"]) && $arResult["EXECUTOR"]["EXECUTOR"] == "Y")
	{
		?>
		<tr>
			<td colspan="2">
				<p style="margin-top: 0;"><?= GetMessage("TPL_EXECUTOR_TITLE") ?>
					<strong><?= $arResult['EXECUTOR']['NAME'] ?></strong>
				<span style="float: right;"><?= GetMessage("TPL_ORG_INN") ?>
					:&nbsp;<strong><?= $arResult["EXECUTOR"]["INN"] ?></strong></span>
				</p>

				<?
				if ($arResult['EXECUTOR']['ADDRESS'])
				{
					?><p><?= GetMessage("TPL_ADDRESS") ?>: <strong><?= $arResult['EXECUTOR']['ADDRESS'] ?></strong>
					</p><?
				}

				if ($arResult['EXECUTOR']['PHONE'])
				{
					?><p><?= GetMessage("TPL_PHONE_FAX") ?>: <strong
					style="margin-left: 1.5em;"><?= $arResult['EXECUTOR']['PHONE'] ?></strong></p><?
				}
				?>

			</td>
		</tr>
	<?
	}
	?>
</table>