<?
use Citrus\Tszh\Types\ComponentType;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// атрибуты файла обмена, из которых берутся данные
$sourceFields = array(
	array(
		"name",
		"edizm",
		"ammount",
		$arResult["HAS_AMOUNT_NOTES"] ? '*' : null,
		"hammount",
		$arResult["HAS_AMOUNT_NOTES"] ? '*' : null,
		"tarif1..tariff3",
		"sum-hsum",
		"hsum",
		"sum",
		"raise_multiplier",
		"raise_sum",
		"correction",
		"compensation",
		$arResult["HAS_PENALTIES"] ? 'peni' : null,
		"sumtopay",
		"sumtopay-hsumtopay",
		"hsumtopay",
	),
	array(
		"norm-hnorm",
		"hnorm",
		"meter",
		"hmeter",
		"volumep",
		"volumea",
		"volumeh",
	),
);
$colsCount = array();
foreach ($sourceFields as $idx => &$sf)
{
	$sf = array_values(array_diff($sf, array(null)));
	$colsCount[$idx] = count($sf);
}
unset($sf);

?>
<table class="rcpt-inner rcpt-inner-table" style="border: none; margin-top: 1.5em; width: 100%;">
	<tr class="rcpt-inner-empty">
		<td colspan="<?=(count($sourceFields[0]))?>" style="width: 66%;">
			<?=GetMessage("TPL_SECTION3")?>
		</td>
		<td rowspan="5" style="border-bottom: 1pt solid #fff; width: 2.5em;"></td>
		<?
		if (!$arResult["IS_FINES_RECEIPT"])
		{
			?>
			<td colspan="<?=(count($sourceFields[1]))?>">
				<?=GetMessage("TPL_SECTION4")?>
			</td>
			<?
		}
		else
		{
			?>
			<td colspan="<?=(count($sourceFields[1]))?>" style="border: none"></td>
			<?
		}
		?>
	</tr>
	<tr>
		<th rowspan="3" style="width: 15%"><?=GetMessage("TPL_SERVICES")?></th>
		<th rowspan="3"><?=GetMessage("TPL_UNITS")?></th>
		<th rowspan="2" colspan="<?=($arResult["HAS_AMOUNT_NOTES"] ? 4 : 2)?>"><?=GetMessage("TPL_SERVICE_AMOUNT")?></th>
		<th rowspan="3"><?=GetMessage("TPL_TARIFF")?></th>
		<th rowspan="2" colspan="2"><?=GetMessage("TPL_SERVICE_PAYMENT")?></th>
		<th rowspan="3"><?=GetMessage("TPL_PERIOD_SUMM")?></th>
        <th rowspan="3"><?=GetMessage("TPL_RAISE_MULTIPLIER")?></th>
        <th rowspan="3"><?=GetMessage("TPL_RAISE_SUM")?></th>
		<th rowspan="3"><?=GetMessage("TPL_PERIOD_CORRECTIONS")?></th>
		<th rowspan="3"><?=GetMessage("TPL_PERIOD_COMPENSATIONS")?></th>
		<?
		if ($arResult["HAS_PENALTIES"])
		{
			?>
			<th rowspan="3"><?=GetMessage("TPL_PERIOD_PENALTIES")?></th><?
		}
		?>
		<th colspan="3"><?=GetMessage("TPL_PERIOD_SUMM_TO_PAY")?></th>

		<?
		if (!$arResult["IS_FINES_RECEIPT"])
		{
			?>
			<th colspan="2" rowspan="2"><?=GetMessage("TPL_NORM")?></th>
			<th colspan="2" rowspan="2"><?=GetMessage("TPL_METERS_CURRENT")?></th>
			<th colspan="3" rowspan="2"><?=GetMessage("TPL_TOTAL_VOLUME")?></th>
			<?
		}
		else
		{
			?><th colspan="<?=$colsCount[1]?>" rowspan="2" style="border: 1pt solid #fff"></th><?
		}
		?>
	</tr>
	<tr>
		<th rowspan="2"><?=GetMessage("TPL_TOTAL")?></th>
		<th colspan="2"><?=GetMessage("TPL_FOR_SERVICE")?></th>
	</tr>
	<tr>
		<th><?=GetMessage("TPL_PERSONAL_CONS")?></th>
		<?
		if ($arResult["HAS_AMOUNT_NOTES"])
			echo '<th>*</th>';
		?>
		<th><?=GetMessage("TPL_SHARED_CONS")?></th>
		<?
		if ($arResult["HAS_AMOUNT_NOTES"])
			echo '<th>*</th>';
		?>
		<th><?=GetMessage("TPL_PERSONAL_CONS")?></th>
		<th><?=GetMessage("TPL_SHARED_CONS")?></th>
		<th><?=GetMessage("TPL_PERSONAL_CONS")?></th>
		<th><?=GetMessage("TPL_SHARED_CONS")?></th>
		<?
		if (!$arResult["IS_FINES_RECEIPT"])
		{
			?>
			<th><?=GetMessage("TPL_PERSONAL_CONS")?></th>
			<th><?=GetMessage("TPL_SHARED_CONS")?></th>
			<th><?=GetMessage("TPL_PERSONAL_CONS1")?></th>
			<th><?=GetMessage("TPL_SHARED_CONS1")?></th>
			<th><?=GetMessage("TPL_PERSONAL_CONS")?></th>
			<th><?=GetMessage("TPL_VOLUMEA")?></th>
			<th><?=GetMessage("TPL_SHARED_CONS")?></th>
			<?
		}
		?>
	</tr>
	<tr class="rcpt-inner-table-num">
		<?
		for ($i = 1; $i <= $colsCount[0] - ($arResult["HAS_AMOUNT_NOTES"] ? 2 : 0); $i++)
		{
			?>
			<th<?=($arResult["HAS_AMOUNT_NOTES"] && ($i == 3 || $i == 4) ? ' colspan="2"' : '')?>><?=$i?></th>
			<?
		}
		if (!$arResult["IS_FINES_RECEIPT"])
		{
			for ($i = 1; $i <= $colsCount[1]; $i++)
			{
				?>
				<th><?=$i?></th>
				<?
			}
		}
		else
		{
			?><th colspan="<?=$colsCount[1]?>" style="border:1pt solid #fff"></th><?
		}
		?>
	</tr>
	<?
	if ($printDebugInfo)
	{
		?>
		<tr class="debug">
			<?
			foreach ($sourceFields as $idx=>$group)
			{
				if ($idx !== 0)
				{
					?><td style="border: 0; background: none"></td><?
				}
				for ($i = 0; $i < count($group); $i++)
				{
					?>
					<td><?=$group[$i]?></td><?
				}
			}
			?>
		</tr>
	<?
	}

	/** @var int $tariffIndex Текущий индекс тарифа (внутри начислений с детализацией соответствует строке детализации, снаружи всегда берется 1-й тариф) */
	$tariffIndex = 0;
	foreach ($arResult['CHARGES'] as $idx => $arCharge)
	{
		/**
		 * Для строк с component=2 вообще не выводим показания ПУ.
		 * Для основной строки таких составных начислений выводим через слеш суммы дневных, ночных и пиковых показаний всех счетчиков этой основной строки
		 *
		 * Для строк с component=1 выводим суммы показаний счетчиков дневного, ночного и пикового показаний для всех счетчиков.
		 * В основной строке ничего не выводим
		 */
		/** @var bool $isComponent Является ли детализаций по составной услуге или детализацией по тарифам */
		$isComponent = $arCharge["COMPONENT"] != ComponentType::NONE;
		/** @var int $tariffIndex Текущий индекс показаний (1 - дневное, 2 - ночное, 3 - пиковое) для детализаций по тарифам */
		$tariffIndex = $isComponent && $arCharge["COMPONENT"] == ComponentType::TARIFFS ? $tariffIndex + 1 : 0;

		// для строк начислений, не имеющих детализации, будем брать первый тариф
		if (!$isComponent && !$arCharge["HAS_COMPONENTS"])
			$tariffIndex = 1;

		$meterValue = $hMeterValue = false;
		if ($tariffIndex > 0)
		{
			$decPlaces = -1;
			// суммируем показания индивидуальных счетчиков по текущему тарифу
			if ($arResult["HAS_CHARGES_METERS_BINDING"])
			{
				$meterValues = array();
				foreach ($arCharge["METER_IDS"] as $meterID)
				{
					$arMeter = $arResult["METERS"][$meterID];
					if (is_array($arMeter) && isset($arMeter["VALUE"]))
					{
						$meterValues[] = $arMeter["VALUE"]["VALUE" . $tariffIndex];
						$decPlaces = max($decPlaces, $arMeter["DEC_PLACES"]);
					}
				}
				$meterValue = empty($meterValues) ? false : count($meterValues) > 1 ? implode($meterValues, '/') : CCitrusTszhReceiptComponentHelper::num(array_sum($meterValues), false, $decPlaces <= 0 ? 2 : $decPlaces);
			}
			else
			{
				$meterValues = array();
				foreach ($arResult["METERS"] as $meterID => $arMeter)
				{
					if (trim($arMeter["~SERVICE_NAME"]) == trim($arCharge["~SERVICE_NAME"]))
					{
						$meterValues[] = $arMeter["VALUE"]["VALUE" . $tariffIndex];
						$decPlaces = max($decPlaces, $arMeter["DEC_PLACES"]);
					}
				}
				$meterValue = empty($meterValues) ? false : CCitrusTszhReceiptComponentHelper::num(array_sum($meterValues), false, $decPlaces <= 0 ? 2 : $decPlaces);
			}

			$decPlaces = -1;
			// суммируем показания общедомовых счетчиков по текущему тарифу
			$hMeterValues = array();
			foreach ($arCharge["HMETER_IDS"] as $hMeterID)
			{
				$hMeter = $arResult["HMETERS"][$hMeterID];
				if (is_array($hMeter) && isset($hMeter["VALUE"]))
				{
					$hMeterValues[] = $hMeter["VALUE"]["VALUE" . $tariffIndex];
					$decPlaces = max($decPlaces, $hMeter["DEC_PLACES"]);
				}
			}
			$hMeterValue = empty($hMeterValues) ? false : CCitrusTszhReceiptComponentHelper::num(array_sum($hMeterValues), false, $decPlaces <= 0 ? 2 : $decPlaces);
		}
		elseif ($arCharge["HAS_COMPONENTS"] === ComponentType::COMPLEX)
		{
			$decPlaces = -1;
			// суммируем показания индивидуальных счетчиков по текущему тарифу
			if ($arResult["HAS_CHARGES_METERS_BINDING"])
			{
				$meterValues = array();
				foreach ($arCharge["METER_IDS"] as $meterID)
				{
					$arMeter = $arResult["METERS"][$meterID];
					if (is_array($arMeter) && isset($arMeter["VALUE"]))
					{
						for ($i = 0; $i < $arMeter["VALUES_COUNT"]; $i++)
						{
							$meterValues[$i] += $arMeter["VALUE"]["VALUE" . ($i+1)];
						}
						$decPlaces = max($decPlaces, $arMeter["DEC_PLACES"]);
					}
				}
				$meterValue = empty($meterValues) ? false : implode('/', $meterValues);
			}
			else
			{
				$meterValues = array();
				foreach ($arResult["METERS"] as $meterID => $arMeter)
				{
					if (trim($arMeter["~SERVICE_NAME"]) == trim($arCharge["~SERVICE_NAME"]))
					{
						for ($i = 0; $i < $arMeter["VALUES_COUNT"]; $i++)
						{
							$meterValues[$i] += $arMeter["VALUE"]["VALUE" . ($i+1)];
						}
						$decPlaces = max($decPlaces, $arMeter["DEC_PLACES"]);
					}
				}
				$meterValue = empty($meterValues) ? false : implode('/', $meterValues);
			}

			$decPlaces = -1;
			// суммируем показания общедомовых счетчиков по текущему тарифу
			$hMeterValues = array();
			foreach ($arCharge["HMETER_IDS"] as $hMeterID)
			{
				$hMeter = $arResult["HMETERS"][$hMeterID];
				if (is_array($hMeter) && isset($hMeter["VALUE"]))
				{
					for ($i = 0; $i < $arMeter["VALUES_COUNT"]; $i++)
					{
						$hMeterValues[$i] += $hMeter["VALUE"]["VALUE" . ($i+1)];
					}
					$decPlaces = max($decPlaces, $hMeter["DEC_PLACES"]);
				}
			}
			$hMeterValue = empty($hMeterValues) ? false : implode('/', $hMeterValues);
		}

		$arTariffs = array();
		for ($i = 0; $i < 3; $i++)
		{
			$fieldName = "SERVICE_TARIFF";
			if ($i)
				$fieldName .= $i + 1;
			if ($arCharge[$fieldName])
				$arTariffs[] = $arCharge[$fieldName];
		}

		if ($arResult["HAS_GROUPS"] && ($idx == 0 || $arResult["CHARGES"][$idx-1]["GROUP"] != $arCharge["GROUP"]))
		{
			?>
			<tr class="rcpt-group-title">
				<td colspan="<?=($colsCount[0])?>">
					<?=$arCharge["GROUP"]?>
				</td>
				<td style="border: 1pt solid #fff"></td>
				<td colspan="<?=($colsCount[1])?>"<?=($arResult["IS_FINES_RECEIPT"] ? ' style="border: 1px solid #fff;"' : '')?>"></td>
			</tr>
			<?
		}
		?>
        <?if ($arCharge["IS_INSURANCE"] != "Y"):?>
		<tr>
			<td><?=$arCharge['SERVICE_NAME']?><?=($arCharge["HAS_COMPONENTS"] && substr($arCharge['SERVICE_NAME'], -1, 1) !== ':' ? ':' : '')?></td>
			<td class="center"><?=CCitrusTszhReceiptComponentHelper::getArrayValue(array('UNITS'), $arCharge, false, $arCharge["SERVICE_UNITS"])?></td>
			<?php
			// заменим значение на представление из 1С
			if (isset($arCharge["AMOUNT_VIEW"]) && strlen($arCharge["AMOUNT_VIEW"])) : ?>
				<td class="n"><?=$arCharge["AMOUNT_VIEW"]?></td>
			<?php else : ?>
				<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue(array("AMOUNT"), $arCharge, true, $arCharge['AMOUNT'] - $arCharge['HAMOUNT'], 3)?></td>
			<?php endif; ?>
			<?
			if ($arResult["HAS_AMOUNT_NOTES"])
			{
				?><td class="center"><?=$arCharge["AMOUNTN"]?></td><?
			}
			?>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue('HAMOUNT', $arCharge, true, false, 3)?></td>
			<?
			if ($arResult["HAS_AMOUNT_NOTES"])
			{
				?><td class="center"><?=$arCharge["HAMOUNTN"]?></td><?
			}
			?>
			<td class="n"><?=$arCharge["RATE"]?></td>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue(array((($arCharge["SUM_WITHOUT_RAISE"] != 0) ? "SUM_WITHOUT_RAISE" : "SUMM"), "HSUMM"), $arCharge, true, (($arCharge["SUM_WITHOUT_RAISE"] != 0) ? $arCharge["SUM_WITHOUT_RAISE"] : $arCharge["SUMM"]) - $arCharge["HSUMM"])?></td>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue('HSUMM', $arCharge, true)?></td>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue((($arCharge["SUM_WITHOUT_RAISE"] != 0) ? "SUM_WITHOUT_RAISE" : "SUMM"), $arCharge, true)?></td>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue('RAISE_MULTIPLIER', $arCharge, true)?></td>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue('RAISE_SUM', $arCharge, true)?></td>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue('CORRECTION', $arCharge, true)?></td>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue('COMPENSATION', $arCharge, true)?></td>
			<?
			if ($arResult['HAS_PENALTIES'])
			{
				?>
				<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue('PENALTIES', $arCharge, true)?></td><?
			}
			?>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue((($arCharge["CSUM_WITHOUT_RAISE"] != 0) ? "CSUM_WITHOUT_RAISE" : "SUMM2PAY"), $arCharge, true)?></td>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue(array((($arCharge["CSUM_WITHOUT_RAISE"] != 0) ? "CSUM_WITHOUT_RAISE" : "SUMM2PAY"), "HSUMM2PAY"), $arCharge, true, (($arCharge["CSUM_WITHOUT_RAISE"] != 0) ? $arCharge["CSUM_WITHOUT_RAISE"] : $arCharge["SUMM2PAY"]) - $arCharge["HSUMM2PAY"])?></td>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue("HSUMM2PAY", $arCharge, true)?></td>

			<td style="border: none<?=($idx == count($arResult["CHARGES"])-1 ? '; border-bottom: 1px solid #fff;' : '')?>">&nbsp;&nbsp;</td>
			<?
			if (!$arResult["IS_FINES_RECEIPT"])
			{
				?>
				<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue(array("NORM", "HNORM"), $arCharge, true, $arCharge["SERVICE_NORM"]/* - $arCharge["HNORM"]*/, 3)?></td>
				<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue("HNORM", $arCharge, true, false, 3)?></td>

				<td class="n" style="white-space: nowrap;"><?=$meterValue?></td>
				<td class="n"><?=$hMeterValue?></td>

				<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue("VOLUMEP", $arCharge, true, false, 3)?></td>
				<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue("VOLUMEA", $arCharge, true, false, 3)?></td>
				<td class="n"><?=CCitrusTszhReceiptComponentHelper::getArrayValue("VOLUMEH", $arCharge, true, false, 3)?></td>
				<?
			}
			else
			{
				?><td colspan="<?=$colsCount[1]?>" style="border: 1px solid #fff;"></td><?
			}
			?>
		</tr>
        <?endif;?>
	<?
	}

	$firstCols = $arResult["HAS_AMOUNT_NOTES"] ? 7 : 5;
	?>
	<tr class="rcpt-inner-table-footer">
        <?if (isset($arResult["INSURANCE"])):?>
		<td colspan="<?=$firstCols?>"><?=GetMessage("TPL_PERIOD_TOTAL_TO_PAY_WITHOUT_INSURANCE")?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["_SUMM"])?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["HSUMM"])?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["CSUM_WITHOUT_RAISE"] )?></td>
        <td class="n"></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["RAISE_SUM"])?></td>
		<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["CORRECTION"])?></td>
		<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["COMPENSATION"])?></td>
		<?if ($arResult["HAS_PENALTIES"]):?>
			<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["PENALTIES"])?></td>
		<?endif?>
		<td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["SUMM2PAY"])?></td>
		<td colspan="<?=(array_sum($colsCount)-6-$firstCols)?>" style="border: none;"></td>
	</tr>
    <tr>
        <td><?=$arResult["INSURANCE"]["SERVICE_NAME"].GetMessage("TPL_FOR").CTszhPeriod::Format(date('Y-m-d',strtotime($arResult["ACCOUNT_PERIOD"]["PERIOD_DATE"]." +2 month")));?></td>
        <td></td>
        <td class="n"><?=$arResult["INSURANCE"]["AMOUNT"];?></td>
        <td></td>
        <td class="n"><?=$arResult["INSURANCE"]["RATE"];?></td>
        <td class="n"><?=$arResult["INSURANCE"]["SUMM"];?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num(0)?></td>
        <td class="n"><?=$arResult["INSURANCE"]["SUMM"];?></td>
        <td></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num(0)?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num(0)?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num(0)?></td>
        <td class="n"><?=$arResult["INSURANCE"]["SUMM"];?></td>

    </tr>
    <tr class="rcpt-inner-table-footer">
        <td colspan="<?=$firstCols?>"><?=GetMessage("TPL_PERIOD_TOTAL_TO_PAY_WITH_INSURANCE")?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["_SUMM"] + $arResult["INSURANCE"]["SUMM"])?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["HSUMM"])?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["CSUM_WITHOUT_RAISE"] + $arResult["INSURANCE"]["SUMM"])?></td>
        <td class="n"></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["RAISE_SUM"])?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["CORRECTION"])?></td>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["COMPENSATION"])?></td>
        <?if ($arResult["HAS_PENALTIES"]):?>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["PENALTIES"])?></td>
        <?endif?>
        <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["SUMM2PAY"] + $arResult["INSURANCE"]["SUMM"])?></td>
        <td colspan="<?=(array_sum($colsCount)-6-$firstCols)?>" style="border: none;"></td>
        <?else:?>
            <td colspan="<?=$firstCols?>"><?=GetMessage("TPL_PERIOD_TOTAL_TO_PAY")?></td>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["_SUMM"])?></td>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["HSUMM"])?></td>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["CSUM_WITHOUT_RAISE"])?></td>
            <td class="n"></td>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["RAISE_SUM"])?></td>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["CORRECTION"])?></td>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["COMPENSATION"])?></td>
            <?if ($arResult["HAS_PENALTIES"]):?>
                <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["PENALTIES"])?></td>
            <?endif?>
            <td class="n"><?=CCitrusTszhReceiptComponentHelper::num($arResult["TOTALS"]["SUMM2PAY"])?></td>
            <td colspan="<?=(array_sum($colsCount)-6-$firstCols)?>" style="border: none;"></td>
        <?endif;?>
    </tr>
</table>
