<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if($arResult["IS_OVERHAUL"])
{
    $arReplaceBilling = array(
        "#ORG_BANK#" => $arResult["ACCOUNT_PERIOD"]["HOUSE_OVERHAUL_BANK"],
        "#ORG_BIK#" => $arResult["ACCOUNT_PERIOD"]["HOUSE_OVERHAUL_BIK"],
        "#ORG_RS#" => $arResult["ACCOUNT_PERIOD"]["HOUSE_OVERHAUL_RS"],
        "#ORG_KS#" => $arResult["ACCOUNT_PERIOD"]["HOUSE_OVERHAUL_KS"],
    );
    $str_CONTRACTOR_BILLING = GetMessage("CITRUS_TSZH_POST354_BILLING", $arReplaceBilling);
}
else
{
	$arReplaceBilling = array(
		"#ORG_BANK#" => $arResult["ACCOUNT_PERIOD"]["HOUSE_BANK"],
		"#ORG_BIK#" => $arResult["ACCOUNT_PERIOD"]["HOUSE_BIK"],
		"#ORG_RS#" => $arResult["ACCOUNT_PERIOD"]["HOUSE_RS"],
		"#ORG_KS#" => $arResult["ACCOUNT_PERIOD"]["HOUSE_KS"],
	);
	$str_CONTRACTOR_BILLING = GetMessage("CITRUS_TSZH_POST354_BILLING", $arReplaceBilling);
}
?>
<table class="rcpt-inner rcpt-inner-table">
	<tr>
		<th><?=GetMessage("TPL_PAYEE")?></th>
		<th><?=GetMessage("TPL_BANK_INFO")?></th>
		<th><?=GetMessage("TPL_ACCOUNT_NUM")?></th>
		<th><?=GetMessage("TPL_SERVICES")?></th>
		<th><?=GetMessage("TPL_PERIOD_SUMM_TO_PAY")?></th>
	</tr>
	<?
	foreach ($arResult['CONTRACTORS'] as $arContractor)
	{
		?>
		<tr>
			<td><?=$arContractor['CONTRACTOR_NAME']?></td>
			<td><?=$arContractor["CONTRACTOR_EXECUTOR"] != "N" ? $str_CONTRACTOR_BILLING : $arContractor['CONTRACTOR_BILLING']?></td>
			<td style="white-space: nowrap; text-align: center;"><?=GetMessage("TPL_ACCOUNT_SYN")?><?=$arResult['ACCOUNT_PERIOD']['XML_ID']?></td>
			<td><?=$arContractor['CONTRACTOR_SERVICES']?></td>
			<td style="text-align: center;"><?=CCitrusTszhReceiptComponentHelper::num($arContractor['SUMM'] ? $arContractor['SUMM'] : $arContractor['SUMM_CHARGED'])?></td>
		</tr>
	<?
	}
	?>
	<tr>
		<td colspan="5">
			<table width="100%" class="rcpt-inner-inner-no-border">
				<tr>
					<td class="no-border" style="vertical-align: top;">
						<table width="100%" class="rcpt-inner-inner nowrap" style="font-size: 10px; line-height: 1.3;">
							<tr>
								<td style="vertical-align: top">
									<table width="100%" class="rcpt-inner-inner nowrap">
										<tr>
											<td colspan="4"><p><strong style="margin-left: .5em;"><?=GetMessage("TPL_NOTE_INFO")?></strong></p></td>
										</tr>
										<tr>
											<td colspan="3"><?=GetMessage("TPL_PREV_DEBT")?></td>
											<td class="padding-left"><strong><?=CCitrusTszhReceiptComponentHelper::num($arResult["ACCOUNT_PERIOD"]["DEBT_PREV"])?></strong></td>
										</tr>
										<tr>
											<td colspan="3"><?=GetMessage($arResult["ACCOUNT_PERIOD"]["PREPAYMENT"] >= 0 ? "TPL_PREPAYMENT" : "TPL_PREPAYMENT_DOLG")?></td>
											<td class="padding-left"><strong><?=CCitrusTszhReceiptComponentHelper::num(abs($arResult["ACCOUNT_PERIOD"]["PREPAYMENT"]))?></strong></td>
										</tr>
										<tr>
											<td colspan="3"><?=GetMessage("CITRUS_TSZH_POST354_SUMMPAYED")?></td>
											<td class="padding-left"><strong><?=CCitrusTszhReceiptComponentHelper::num(/*$arResult["TOTALS"]["SUMM_PAYED"] + $arResult["INSURANCE"]["SUMM_PAYED"]*/$arResult["ACCOUNT_PERIOD"]["SUM_PAYED"])?></strong></td>
										</tr>
										<?if ($arResult["ACCOUNT_PERIOD"]["CREDIT_PAYED"] > 0):?>
											<tr>
												<td colspan="3"><?=GetMessage("CITRUS_TSZH_POST354_CREDIT_PAYED")?></td>
												<td class="padding-left"><strong><?=CCitrusTszhReceiptComponentHelper::num($arResult["ACCOUNT_PERIOD"]["CREDIT_PAYED"])?></strong></td>
											</tr>
										<?endif?>
                                        <?if ($arResult["INSURANCE"]["SUMM_PAYED"] > 0):?>
                                            <tr>
                                                <td colspan="3"><?=GetMessage("CITRUS_TSZH_POST354_INSURANCE_PAYED")?></td>
                                                <td class="padding-left"><strong><?=CCitrusTszhReceiptComponentHelper::num($arResult["INSURANCE"]["SUMM_PAYED"])?></strong></td>
                                            </tr>
                                        <?endif?>
										<?
										if ($arResult["HAS_SEPARATE_PENALTIES_RECEIPT"])
										{
											?>
											<tr>
												<?if ($arResult["ACCOUNT_PERIOD"]["LAST_PAYMENT"]):?>
													<td colspan="3"><?=GetMessage("TPL_LAST_PAYMENT")?></td>
													<td class="padding-left"><strong><?=$arResult["ACCOUNT_PERIOD"]["LAST_PAYMENT"]?></strong></td>
												<?else:?>
													<td colspan="4"></td>
												<?endif?>
											</tr>
											<?
										}
										else
										{
											?>
											<tr>
												<?if ($arResult["ACCOUNT_PERIOD"]["LAST_PAYMENT"]):?>
													<td><?=GetMessage("TPL_LAST_PAYMENT")?></td>
													<td class="padding-left"><strong><?=$arResult["ACCOUNT_PERIOD"]["LAST_PAYMENT"]?></strong></td>
												<?else:?>
													<td colspan="2"></td>
												<?endif?>
												<td><?=GetMessage("TPL_PERIOD_PENALTIES")?></td>
												<td class="padding-left"><strong><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["PENALTIES"])?></strong></td>
											</tr>
											<?
										}
										?>
									</table>
								</td>
								<td>
									<table width="100%" class="rcpt-inner-inner">
                                        <tr>
                                            <td class="center">
                                                <?if ($arResult["IS_OVERHAUL"] != "Y") {GetMessage("TPL_TO_PAY_WITHOUT_INSURANCE");}?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?
                                                foreach ($arResult["ACCOUNT_PERIOD"]["BARCODES"] as $idx=>$barcode)
                                                {
                                                    /** @noinspection PhpAssignmentInConditionInspection */
                                                    if ($link = CTszhBarCode::getImageLink($barcode))
                                                    {
                                                        $code128 = $barcode["TYPE"] == 'code128';
                                                        ?><td class="no-border rcpt-barcode-cell"><img style="<?=($code128 ? 'width: 5.5cm' : 'width: 3cm; height: 3cm; max-height: 4cm;')?>" class="rcpt-barcode" src="<?=$link?>" alt="<?=htmlspecialcharsbx($barcode["VALUE"])?>"></td><?
                                                    }
                                                }
                                            ?>
                                        </tr>
                                        <tr>
                                <?
                                    foreach ($arResult["ACCOUNT_PERIOD"]["BARCODES_INSURANCE"] as $idx=>$barcode)
                                    {
                                        /** @noinspection PhpAssignmentInConditionInspection */
                                        if ($link = CTszhBarCode::getImageLink($barcode))
                                        {
                                            $code128 = $barcode["TYPE"] == 'code128';
                                            ?><td class="no-border rcpt-barcode-cell"><img style="<?=($code128 ? 'width: 5.5cm' : 'width: 3cm; height: 3cm; max-height: 4cm;')?>" class="rcpt-barcode" src="<?=$link?>" alt="<?=htmlspecialcharsbx($barcode["VALUE"])?>"></td><?
                                        }
                                    }
								?>
									</tr></table>
								</td>
							</tr>
                            <tr>
                                <td><?=GetMessage((($arResult["IS_OVERHAUL"]) || !sizeof($arResult["ACCOUNT_PERIOD"]["BARCODES_INSURANCE"])) ? "TPL_TOTAL_TO_PAY" : "TPL_PERIOD_TO_PAY_WITHOUT_INSURANCE")?><b><?=CCitrusTszhReceiptComponentHelper::num($arResult["ACCOUNT_PERIOD"]["SUMM_TO_PAY"])?> </b></td>
                                <?if (!(($arResult["IS_OVERHAUL"]) || !sizeof($arResult["ACCOUNT_PERIOD"]["BARCODES_INSURANCE"]))):?>
                                <td><?=GetMessage("TPL_PERIOD_TO_PAY_WITH_INSURANCE")?><b><?=CCitrusTszhReceiptComponentHelper::num($arResult["ACCOUNT_PERIOD"]["SUMM_TO_PAY"] + $arResult["INSURANCE"]["SUMM"])?> </b> </td>
                                <?endif;?>
                            </tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>