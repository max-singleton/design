<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult["CORRECTIONS"]))
{
	?>
	<table width="100%" style="margin-top: 1.5em">
		<tr>
			<td>
				<?=GetMessage("TPL_SECTION5")?>
			</td>
		</tr>
		<tr>
			<td style="padding: 0;">
				<table class="rcpt-inner rcpt-inner-table">
					<tr>
						<th><?=GetMessage("TPL_SERVICES")?></th>
						<th><?=GetMessage("TPL_CORRECTION_GROUNDS")?></th>
						<th><?=GetMessage("TPL_SUMM_RUB")?></th>
					</tr>
					<tr class="rcpt-inner-table-num">
						<th>1</th>
						<th>2</th>
						<th>3</th>
					</tr>
					<?
					foreach ($arResult["CORRECTIONS"] as $arCorrection)
					{
						?>
						<tr>
							<td><?=$arCorrection["SERVICE"]?></td>
							<td><?=$arCorrection["GROUNDS"]?></td>
							<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arCorrection['SUMM'])?></td>
						</tr>
					<?
					}
					?>
				</table>
			</td>
		</tr>
	</table>
<?
}
