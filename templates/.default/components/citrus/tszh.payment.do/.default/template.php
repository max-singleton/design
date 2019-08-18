<?

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

if (strlen($arResult["NOTE_MESSAGE"]) > 0)
{
	ShowNote($arResult["NOTE_MESSAGE"]);
}
echo '<div id="note_mess"></div>';

if (!empty($arResult["PAYMENT"]))
{
	if (strlen($arResult["ERROR_MESSAGE"]) > 0)
	{
		ShowError($arResult["ERROR_MESSAGE"]);
	}

	if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
	{
		if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y" && !$arResult["WINDOW"])
		{
			$pathToPayment = str_replace("#ID#", $arResult["PAYMENT"]["ID"], $arParams["MAKE_PAYMENT_URL"]);
			?>
			<script language="javascript">
                window.open('<?=$pathToPayment?>');
			</script>
			<?
			echo str_replace("#LINK#", $pathToPayment, GetMessage("TSZH_PAYMENT_PAY_WIN"));
		}
		else
		{
			if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]) > 0)
			{
				if ($arResult["WINDOW"])
				{
					$APPLICATION->RestartBuffer();
				}
				include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);

				if (strlen($arResult["PAY_SYSTEM"]["ENCODING"]) > 0 && !function_exists('CitrusTszhPaymentChangeEncoding'))
				{
					define("CITRUS_TSZH_PAYMENT_ENCODING", $arResult["PAY_SYSTEM"]["ENCODING"]);
					AddEventHandler("main", "OnEndBufferContent", "CitrusTszhPaymentChangeEncoding");
					function CitrusTszhPaymentChangeEncoding(&$content)
					{
						global $APPLICATION;
						header("Content-Type: text/html; charset=" . CITRUS_TSZH_PAYMENT_ENCODING);
						$content = $APPLICATION->ConvertCharset($content, SITE_CHARSET, CITRUS_TSZH_PAYMENT_ENCODING);
						$content = str_replace("charset=" . SITE_CHARSET, "charset=" . CITRUS_TSZH_PAYMENT_ENCODING, $content);
					}
				}

				if ($arResult["WINDOW"])
				{
					die();
				}
			}
		}
	}
}
else
{
	$path = $arResult["PAY_SYSTEM"]["ACTION_FILE"];

	if ($path && file_exists($_SERVER['DOCUMENT_ROOT'] . $path) && file_exists($_SERVER['DOCUMENT_ROOT'] . $path . '/list.php'))
	{
		include($_SERVER['DOCUMENT_ROOT'] . $path . '/list.php');
	}

	if (strlen($arResult["ERROR_MESSAGE"]) > 0)
	{
		ShowError($arResult["ERROR_MESSAGE"]);
	}

	?>
	<div class="payment-form">
		<form method="post" name="makePayment" action="<?=$arResult["ACTION"]?>">
			<?

			echo bitrix_sessid_post();

			if (IntVal($arParams['PAY_SYSTEM']) > 0)
			{
				?><input type="hidden" name="pay_system_id" value="<?=IntVal($arResult['PAY_SYSTEM']["ID"])?>"><?
			}

			if (isset($arResult["UNATH_PAYMENT"]))
			{
				if (method_exists("CTszh", "hasDemoDataOnly"))
				{
					$arResult["TSZH_HAS_ACCOUNTS"] = array();
					foreach ($arResult["TSZH"] as $tszhID => $tszhName)
					{
						if (!CTszh::hasDemoDataOnly($tszhID))
						{
							$arResult["TSZH_HAS_ACCOUNTS"][$tszhID] = $arResult["TSZH_LIST"][$tszhID]["PHONE"];
						}
					}
					?>
					<div id="tszhAuthNote" class="note" style="display: none;"><?=GetMessage('CITRUS_TSZH_AUTH_NOTE')?></div>
					<script>
	                    window.tszhHasAccounts = <?=CUtil::PhpToJSObject($arResult["TSZH_HAS_ACCOUNTS"])?>;
					</script>
				<?
				}
				?>

			<input type="hidden" name="payment_step2" value="1">
				<table class="citrus-tszh-payment-form">
					<tr>
						<td><span class="starrequired">*</span> <?=GetMessage("CITRUS_TSZH_PAYEE_NAME")?></td>
						<td><input name="C_PAYEE_NAME" value="<?=$arResult["FIELDS"]["C_PAYEE_NAME"]?>" class="styled" required></td>
					</tr>
					<tr>
						<td><span class="starrequired">*</span> <?=GetMessage("CITRUS_TSZH_C_ADDRESS")?></td>
						<td><input name="C_ADDRESS" value="<?=$arResult["FIELDS"]["C_ADDRESS"]?>" class="styled"
						           placeholder="<?=GetMessage("CITRUS_TSZH_C_ADDRESS_TOOLTIP")?>" required></td>
					</tr>
					<!--<tr>
				<td><span class="starrequired">*</span> <?/*=GetMessage("CITRUS_TSZH_TSZH_ID")*/
					?></td>
				<td>
					<?/*
					if (count($arResult["TSZH_LIST"]) == 1)
					{
						$tszh = array_shift($arResult["TSZH_LIST"]);
						*/
					?><input type="hidden" name="TSZH_ID" value="<?/*=$tszh['ID']*/
					?>" class="styled"><?/*
						*/
					?><input type="text" value="<?/*=$tszh['NAME']*/
					?>" disabled="disabled" class="styled"><?/*
					}
					else
					{
						*/
					?><select name="TSZH_ID" class="styled" required><option value="" default <?/*=(array_key_exists($arResult["FIELDS"]["TSZH_ID"], $arResult["TSZH"]) ? '' : ' selected')*/
					?>><?/*=GetMessage("CITRUS_TSZH_SELECT")*/
					?></option>
						<?/*
						foreach ($arResult["TSZH_LIST"] as $tszh)
						{
							echo '<option value="' . $tszh['ID'] . '"' . ($tszh['ID'] == $arResult["FIELDS"]["TSZH_ID"] ? ' selected' : '') .'>' . $tszh['NAME'] . '</option>';
						}
						*/
					?></select><?/*
					}
					*/
					?>
				</td>
			</tr>-->
					<tr>
						<td colspan="2"><input type="hidden" name="TSZH_ID" value="<?= $arParams['TSZH_ID'] ?>"></td>
					</tr>
					<tr>
						<td><span class="starrequired">*</span> <?=GetMessage("CITRUS_TSZH_C_ACCOUNT")?></td>
						<td><input name="C_ACCOUNT" id="C_ACCOUNT" onblur="verifyAccount();" value="<?=$arResult["FIELDS"]["C_ACCOUNT"]?>"
						           class="styled" required></td>
					</tr>
					<tr>
						<td><span class="starrequired">*</span> <?=GetMessage("CITRUS_TSZH_SUMM")?> (<?=$arResult['CURRENCY_TITLE']?>)</td>
						<td><input type="text" name="<?=$arParams['VAR']?>" value="<?=$arResult["AMOUNT_TO_SHOW"]?>" size="8" class="styled"
						           required/></td>
					</tr>
					<tr>
						<td><?=GetMessage("CITRUS_TSZH_C_COMMENTS")?></td>
						<td><textarea name="C_COMMENTS" class="styled" rows="5"
						              placeholder="<?=GetMessage("CITRUS_TSZH_C_COMMENTS_TOOLTIP")?>"><?=$arResult["FIELDS"]["C_COMMENTS"]?></textarea>
						</td>
					</tr>
					<?
					foreach ($arResult["USER_FIELDS"] as $field)
					{
						?>
						<tr>
							<td><?
								if ($field["MANDATORY"] == "Y")
								{
									?><span class="starrequired">*</span> <?
								}
								?><?=$field["EDIT_FORM_LABEL"]?></td>
							<td><?
								$APPLICATION->IncludeComponent(
									"bitrix:system.field.edit",
									$field["USER_TYPE_ID"],
									array("arUserField" => $field), null, array("HIDE_ICONS" => "Y"));
								?></td>
						</tr>
						<?
					}
					?>
					<?php
					/*if ($arResult['IS_BUDGET']) :
						?>
						<table class="citrus-tszh-payment-form">
							<tr>
								<td colspan="2">
									<div class="is-budget__note"><?=Loc::getMessage("TSZH_PAYMENT_IS_BUDGET_NOTE")?></div>
									<div class="is-budget__label"><?=Loc::getMessage("TSZH_PAYMENT_DOCUMENT_TYPE")?></div>
									<div class="tszh-payment-select" id="tszh-payment-select">
										<select name="DOCUMENT_TYPE" id="DOCUMENT_TYPE">
											<?php
											foreach ($arResult['PAYER_ID']['DOCUMENT_TYPE']['LIST'] as $document_type => $document_type_caption)
											{
												$selected = isset($arResult['PAYER_FIELDS']['DOCUMENT_TYPE']) && $arResult['PAYER_FIELDS']['DOCUMENT_TYPE'] == $document_type ? 'selected' : '';
												echo "<option {$selected} value='{$document_type}'>{$document_type_caption}</option>";
											}
											?>
										</select>
									</div>
									<div class="is-budget__label"><?=Loc::getMessage("TSZH_PAYMENT_DOCUMENT_NUMBER")?></div>
									<input name="DOCUMENT_NUMBER" id="DOCUMENT_NUMBER"
									       value="<?=(isset($arResult['PAYER_FIELDS']['DOCUMENT_NUMBER']) ? $arResult['PAYER_FIELDS']['DOCUMENT_NUMBER'] : '')?>"
									       class="styled" required>
									<div class="is-budget__label"><?=Loc::getMessage("TSZH_PAYMENT_NATIONALITY")?></div>
									<select name="NATIONALITY" id="NATIONALITY" class="styled">
										<?php
										foreach ($arResult['PAYER_ID']['NATIONALITY']['LIST'] as $nat_code => $nat_caption)
										{
											$selected = isset($arResult['PAYER_FIELDS']['NATIONALITY']) && $arResult['PAYER_FIELDS']['NATIONALITY'] == $nat_code ? 'selected' : '';
											echo "<option {$selected} value='{$nat_code}'>{$nat_caption}</option>";
										}
										?>
									</select>
								</td>
							</tr>
						</table>
					<?php
					endif;*/
					?>
					<?php
					if ($tszh['CONFIRM_PARAM'] == 'Y') :
						?>
						<tr>
							<td></td>
							<td>
								<p><input name="confirm" class="confirm" value="Y" type="checkbox" required> <?=$tszh['~CONFIRM_TEXT']?> </p><br>
							</td>
						</tr>
					<? endif; ?>
				</table>
				<input type="submit" name="button" class="link-theme-default" value="<?=GetMessage("TSZH_PAYMENT_BUTTON_DO")?>"/>
			<?php
			}
			else
			{
			if ($USER->IsAuthorized())
			{
			foreach ($arResult["USER_FIELDS"] as $field)
			{
			?>
				<div>
					<?=$field["EDIT_FORM_LABEL"]?>:<br>
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:system.field.edit",
						$field["USER_TYPE_ID"],
						array("arUserField" => $field), null, array("HIDE_ICONS" => "Y"));
					?>
				</div>
				<?
			}
			}
				?><p><?
			if ($USER->IsAuthorized())
			{
				?>
				<p><span class="bold"><?=GetMessage("TSZH_PERSONAL_ACCOUNT")?>
						:</span> <?=GetMessage("TSZH_PERSONAL_ACCOUNT_NUMBER") . $arResult['ACC']['XML_ID']?></p>
				<p><span class="bold"><?=GetMessage("TSZH_PAYMENT_PERIOD")?>:</span> <?=$arResult['LAST_PERIOD']?></p>
				<p><span class="bold"><?=GetMessage("TSZH_SUMM_PAYMENT")?>:</span> <input class="payment-form__input" type="text"
				                                                                          name="<?=$arParams['VAR']?>" size="8"
				                                                                          value="<?=$arResult["AMOUNT_TO_SHOW"]?>"/> <?=$arResult['CURRENCY_TITLE']?>
				</p>

				<?php
				/* if ($arResult['IS_BUDGET']) :
				?>
				<table class="citrus-tszh-payment-form">
					<tr>
						<td colspan="2">
							<div class="is-budget__note"><?=Loc::getMessage("TSZH_PAYMENT_IS_BUDGET_NOTE")?></div>
							<div class="is-budget__label"><?=Loc::getMessage("TSZH_PAYMENT_DOCUMENT_TYPE")?></div>
							<div class="tszh-payment-select" id="tszh-payment-select">
								<select name="DOCUMENT_TYPE" id="DOCUMENT_TYPE">
									<?php
									foreach ($arResult['PAYER_ID']['DOCUMENT_TYPE']['LIST'] as $document_type => $document_type_caption)
									{
										$selected = isset($arResult['PAYER_FIELDS']['DOCUMENT_TYPE']) && $arResult['PAYER_FIELDS']['DOCUMENT_TYPE'] == $document_type ? 'selected' : '';
										echo "<option {$selected} value='{$document_type}'>{$document_type_caption}</option>";
									}
									?>
								</select>
							</div>
							<div class="is-budget__label"><?=Loc::getMessage("TSZH_PAYMENT_DOCUMENT_NUMBER")?></div>
							<input name="DOCUMENT_NUMBER" id="DOCUMENT_NUMBER"
							       value="<?=(isset($arResult['PAYER_FIELDS']['DOCUMENT_NUMBER']) ? $arResult['PAYER_FIELDS']['DOCUMENT_NUMBER'] : '')?>"
							       class="styled" required>
							<div class="is-budget__label"><?=Loc::getMessage("TSZH_PAYMENT_NATIONALITY")?></div>
							<select name="NATIONALITY" id="NATIONALITY" class="styled">
								<?php
								foreach ($arResult['PAYER_ID']['NATIONALITY']['LIST'] as $nat_code => $nat_caption)
								{
									$selected = isset($arResult['PAYER_FIELDS']['NATIONALITY']) && $arResult['PAYER_FIELDS']['NATIONALITY'] == $nat_code ? 'selected' : '';
									echo "<option {$selected} value='{$nat_code}'>{$nat_caption}</option>";
								}
								?>
							</select>
						</td>
					</tr>
				</table>
			<?php
			endif;*/
				?>

				<?
				}
				?>

			<?
			if ($arResult["TSZH"]["CONFIRM_PARAM"] == "Y")
			{
				if ($arResult["CONFIRM_ACC"] != "Y")
				{
					?>

					<p>
						<input name="confirm" class=confirm type="checkbox" value="Y" required>
						<?=$arResult["TSZH"]["~CONFIRM_TEXT"]?>
					</p>
				<br>
				<?
				}
			}
				?>
				<input type="submit" name="button" class="link-theme-default" value="<?=GetMessage("TSZH_PAYMENT_BUTTON_DO")?>"/>
				<?
			}
			?>
		</form>
	</div>
	<?
	if (isset($arResult['LAST_PAYMENT']))
	{
		echo "<p>" . GetMessage('TSZH_LAST_PAYMENT', array(
				'#DATE#' => $arResult["LAST_PAYMENT"]["DATE"],
				'#SUM#' => $arResult["LAST_PAYMENT"]["SUMM"],
			)) . "</p>";
	}
	?>
	<?
}
