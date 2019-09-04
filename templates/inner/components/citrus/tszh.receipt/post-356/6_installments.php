<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (is_array($arResult["INSTALLMENTS"]) && !empty($arResult["INSTALLMENTS"]))
{
	?>
	<table style="width: 57%; float: right;">
		<tbody>
		<tr>
			<td>
				<?=GetMessage("TPL_SECTION6")?>
			</td>
		</tr>
		<tr>
			<td style="padding: 0;">
				<table class="rcpt-inner rcpt-inner-table">
					<tbody>
					<tr>
						<th rowspan="2"><?=GetMessage("CITRUS_TSZH_POST354_INSTALLMENT_SERVICES")?></th>
						<th colspan="2"><?=GetMessage("CITRUS_TSZH_POST354_INSTALLMENT_SUMM1")?></th>
						<th colspan="2"><?=GetMessage("CITRUS_TSZH_POST354_INSTALLMENT_PERCENT")?></th>
						<th rowspan="2"><?=GetMessage("CITRUS_TSZH_POST354_INSTALLMENT_SUMM2")?></th>
					</tr>
					<tr>
						<th><?=GetMessage("CITRUS_TSZH_POST354_INSTALLMENT_SUMM1_1")?></th>
						<th><?=GetMessage("CITRUS_TSZH_POST354_INSTALLMENT_SUMM1_2")?></th>
						<th><?=GetMessage("CITRUS_TSZH_POST354_INSTALLMENT_CURRENCY")?></th>
						<th>%</th>
					</tr>
					<tr class="rcpt-inner-table-num">
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
					</tr>
					<?
					$totalSumm = 0;
					foreach ($arResult["INSTALLMENTS"] as $arInstallment)
					{
						$totalSumm += $arInstallment["SUMM2PAY"];
						?>
						<tr>
							<td><?=$arInstallment["SERVICE"]?></td>
							<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arInstallment["SUMM_PAYED"])?></td>
							<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arInstallment["SUMM_PREV_PAYED"])?></td>
							<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arInstallment["SUMM_RATED"])?></td>
							<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arInstallment["PERCENT"])?></td>
							<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arInstallment["SUMM2PAY"])?></td>
						</tr>
					<?
					}
					?>
					</tbody>
					<tfoot>
					<tr>
						<th colspan="5"><?=GetMessage("CITRUS_TSZH_POST354_INSTALLMENT_TOTAL")?></th>
						<td class="n"><strong><?=CCitrusTszhReceiptComponentHelper::num($totalSumm)?></strong></td>
					</tr>
					</tfoot>
				</table>
			</td>
		</tr>
		</tbody>
	</table>
	<?
}