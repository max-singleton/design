<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

if (empty($arResult['METERS'])) :
	ShowNote(GetMessage("CITRUS_TSZH_METER_VALUES_NOT_FOUND"));
else :
?>

<div class="met-history">
	<div class="met-history__title">
		<p><span class="bold"><?=GetMessage("CITRUS_TSZH_METERS_NAME")?></span> <?=$arResult["METERS"]["NAME"]?></p>
		<p><span class="bold"><?=GetMessage("CITRUS_TSZH_METERS_NUM")?></span> <?=$arResult["METERS"]["NUM"]?></p>
		<p><span class="bold"><?=GetMessage("CITRUS_TSZH_METERS_SERVICE_NAME")?></span> <?=$arResult["METERS"]["SERVICE_NAME"]?></p>
	</div>
	<div class="met-history__block">
		<?php
		$chart1_vals = '';
		$chart1_captions = '';
		foreach ($arResult['tariffs'] as $met_periods)
		{
			?>
			<table class="table1">
				<?php if (isset($met_periods['name'])) { ?>
					<thead>
					<tr>
						<td colspan="3"><?=$met_periods['name']?></td>
					</tr>
					</thead>
				<?php } ?>
				<tbody>
				<tr>
					<td><?=GetMessage("CITRUS_TSZH_METERS_DATE_INPUT")?></td>
					<td><?=GetMessage("CITRUS_TSZH_METERS_VALUE")?></td>
					<td><?=GetMessage("CITRUS_TSZH_CONSUMPTION")?></td>
				</tr>
				<?php
				foreach ($met_periods['periods'] as $met_period)
				{
					?>
					<tr>
						<td>
							<?=$arResult["ROWS"][$met_period['date']]["INPUT_DATE"]?>
						</td>
						<td>
							<?=(float)$met_period['data']?>
						</td>
						<td>
							<?=(float)$met_period['rate']?>
						</td>
					</tr>
					<?php
				}

				if ($arResult["FLAG_NAV"])
					{
						?>
						<tr>
							<td colspan="3">
								<?
								$APPLICATION->IncludeComponent(
									"bitrix:main.pagenavigation",
									"",
									array(
										"NAV_OBJECT" => $arResult["NAV"],
										"SEF_MODE" => "N",
										"SHOW_COUNT" => "Y",
										"COMPONENT_TEMPLATE" => ".default",
									),
									false
								);
								?>
							</td>
						</tr>
						<?
					}
					if (count($met_periods['periods']) == 0)
					{
						?>
						<tr>
							<td colspan="3">
								<?=GetMessage("CITRUS_TSZH_NO_DATA");?>
							</td>
						</tr>
						<?
					}
					?>					
				</tbody>
			</table>
			<?php
		}
		?>
		<div class="chart1-xy" x-label="<?=GetMessage("CITRUS_TSZH_PERIOD")?>" y-label="<?=GetMessage("CITRUS_TSZH_CONSUMPTION")?>"
		     captions="<?=$arResult["chart1_captions"]?>" ratio-yx="0.333" stroke-width="0.4" values-polyline="<?=$arResult["chart1_vals"]?>">
		</div>
	</div>
</div>
<?php endif; ?>
<script>
    $(document).ready(function () {
        new_href = <?echo \Bitrix\Main\Web\Json::encode($arResult["BACK_URL"], $options = null);?>;
        $(this).find('.content__page').find('.breadcrumbs').find('.breadcrumbs__link').attr("href", new_href);
    });
</script>